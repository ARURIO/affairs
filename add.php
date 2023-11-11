<?php
//В начале скрипта подключаются необходимые файлы
require_once ("functions/db.php");
require_once ("functions/helpers.php");
require_once ("functions/models.php");
require_once ("functions/validators.php");
require_once ("functions/template.php");

$allProjects = getAllProjects($con);
$allProjects_id = array_column($allProjects, "project_id");
$allTasks = getAllTasks($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST;
    $errors = [];

    // Проверка имени задачи
    if (empty($task['name'])) {
        $errors['name'] = 'Это поле необходимо заполнить';
    }

    // Проверка даты
    if (!is_date_valid($task['date'])) {
        $errors['date'] = 'Введите дату в формате ГГГГ-ММ-ДД';
    } elseif (strtotime($task['date']) < time()) {
        $errors['date'] = 'Дата должна быть больше или равна текущей';
    }

    // Проверка проекта
    if (empty($task['project_id']) || !in_array($task['project_id'], $allProjects_id)) {
        $errors['project_id'] = 'Выберите существующий проект';
    }

    // Проверка загрузки файла
    if (!empty($_FILES['file']['name'])) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_path = 'uploads/' . $file_name;

        move_uploaded_file($file_tmp, $file_path);
        $task['file_path'] = $file_path;
    }

    if (empty($errors)) {
        var_dump($task);
        // Получение имени проекта из массива $allProjects
        $projectName = $allProjects[array_search($task['project_id'], array_column($allProjects, 'id'))]['project_name'];

        $taskData = [
            0, // status
            $task['name'], // name_tasks
            $projectName, // project_name
            $task['file_path'], // file_link
            $task['date'], // date_of_completion
            1, // user_id (фиктивное значение)
            $task['project_id'] // project_id
        ];

        $task_id = addTask($con, $taskData);

        if ($task_id) {
            header("Location: index.php");
            exit;
        }
    }

}

$page_content = include_template("add-form-task.php", [
    "task" => $task,
    "allProjects" => $allProjects,
    "allTasks" => $allTasks,
    "errors" => $errors
]);



$layout_content = include_template("layout.php", [
    "content" => $page_content,
    "title" => "Добавление задачи"
]);


print($layout_content);
