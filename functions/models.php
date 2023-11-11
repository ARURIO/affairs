<?php

/*Проверяет существование проекта в базе данных
 *@param  integer $project_id идентификатор проекта, который извлекается из параметра запроса
 * @return true или false
 */
function projectExists($project_id, $con)
{
    //Используем подготовленный запрос для безопасности
    $sql = "SELECT COUNT(*) FROM projects WHERE project_id = ?";
    //Создаем подготовленное выражение
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        //Привязываем значение project_id к подготовленному выражению
        mysqli_stmt_bind_param($stmt, "i", $project_id);
        //выполняем запрос
        mysqli_stmt_execute($stmt);
        // Связывание результатов запроса с переменными
        mysqli_stmt_bind_result($stmt, $countProj);
        // Извлечение данных
        mysqli_stmt_fetch($stmt);
        // Если найдена хотя бы одно совпадение, возвращает true, иначе false
        return $countProj > 0;
    } else {
        //Обработка ошибки подготовленного запроса
        return false;
    }
}


/*Добавляет проверку на существование параметра запроса с идентификатором проекта
   в массиве $_GET и получаем его значение */
function checkProjectParameter($con) {
    if (isset($_GET['project_id'])) {
        $project_id = intval($_GET['project_id']);
        if (projectExists($project_id, $con)) {
            return $project_id;
        } else {
            http_response_code(404);
            exit("Проект не найден");
        }
    } else {
        return null;
    }
}

/**
 * Возвращает массив категорий
 * @param $con подключение к MySQL
 * @return $error Описание последней ошибки подключения
 * @return array $allProjects Ассоциативный массив с категориями проектов из базы данных
 */
function getAllProjects($con)
{
    if (!$con) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        $sql = "SELECT character_code, project_name, projects.project_id FROM projects;";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $allProjects = get_arrow($result);
            return $allProjects;
        } else {
            $error = mysqli_error($con);
            return $error;
        }
    }
}


/**
 * Возвращает массив всех задач
 * @param $con подключение к MySQL
 * @return $error Описание последней ошибки подключения
 * @return array $allTasks Ассоциативный массив с категориями проектов из базы данных
 */
function getAllTasks($con)
{
    if (!$con) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        $sql = "SELECT task_id, name_tasks, tasks.project_name, file_link,
       date_of_completion, tasks.project_id FROM tasks;";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $allTasks = get_arrow($result);
            return $allTasks;
        } else {
            $error = mysqli_error($con);
            return $error;
        }
    }
}


/*Составляем запрос для выборки задач так, чтобы он учитывал выбранный проект.
Если проект project_id существует и не равен null, то добавляем условие для выборки только тех задач ,
относящихся к выбранному проекту, в противном случае показывать все задачи
 * Возвращает массив  задач выбранного проекта по его id
 * @param $con подключение к MySQL
 * @return $error Описание последней ошибки подключения
 * @return array $taskOfProjects Ассоциативный массив с задачами  проекта из базы данных
 */
function getTaskOfProjects($con, $project_id)
{
    if ($con && !is_null($project_id)) {
        $sql = "SELECT task_id, name_tasks, tasks.project_name, file_link, date_of_completion, tasks.project_id FROM tasks 
                JOIN projects ON tasks.project_id = projects.project_id
                WHERE projects.project_id = $project_id";
    } else {
        $sql = "SELECT task_id, name_tasks, tasks.project_name, file_link, date_of_completion FROM tasks";
    }

    $resultTasks = mysqli_query($con, $sql);
    if (!$resultTasks) {
        $error = mysqli_error($con);
        exit('При выполнении запроса возникла ошибка' . $error);
    } else {
        $tasksOfProjects = mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);
        return $tasksOfProjects;
    }
}

/**
 * Функция для добавления новой задачи в базу данных с использованием подготовленных запросов.
 *
 * @param mysqli $con Объект соединения с базой данных
 * @param array $data Данные задачи для вставки в базу данных
 *
 * @return int|false ID вставленной задачи в случае успеха, иначе возвращает false
 */
function addTask($con, $data) {
    $sql = "INSERT INTO tasks (date_of_creation, status, name_tasks, project_name, file_link, date_of_completion, user_id, project_id)
            VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)";

    $stmt = db_get_prepare_stmt($con, $sql, $data);

    if (!mysqli_stmt_execute($stmt)) {
        die('Ошибка выполнения запроса: ' . mysqli_error($con));
    }

    return mysqli_insert_id($con);
}