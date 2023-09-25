<?php
//В начале скрипта подключаются необходимые файлы
require_once("helpers.php");
require_once("functions.php");
require_once("data.php");
require_once ("init.php");

//Этот код извлекает информацию о проектах из базы данных и сохраняет её в массиве `$projects`
if ($con) {
    $sql = "SELECT character_code, project_name, projects.project_id FROM projects";
    $resultProj = mysqli_query($con, $sql);
    if ($resultProj) {
        $projects = mysqli_fetch_all($resultProj, MYSQLI_ASSOC);

    } else {
        $error = mysqli_error($con);
        exit('При выполнении запроса возникла ошибка' . $error);
    }
}
/* Этот код извлекает и информацию о задачах для функции  подсчета count_tasks
 из базы данных и сохраняет ее в массиве countTask */
        if ($con) {
            $sql = "SELECT task_id, name_tasks, tasks.project_name, file_link,
       date_of_completion, tasks.project_id FROM tasks";
            $resultCountTasks = mysqli_query($con, $sql);
            if ($resultCountTasks) {
                $countTasks = mysqli_fetch_all($resultCountTasks, MYSQLI_ASSOC);
            }
        }


/*Добавляет проверку на существование параметра запроса с идентификатором проекта
в массиве $_GET и получаем его значение */
           $project_id = isset($_GET['project_id'])?intval($_GET['project_id']):null;

/*Составляем запрос для выборки задач так, чтобы он учитывал выбранный проект.
Если проект project_id существует и не равен null, то добавляем условие для выборки только тех задач ,
относящихся к выбранному проекту, в противном случае показывать все задачи */
        if ($con && !is_null($project_id)) {
            $sql = "SELECT task_id, name_tasks, tasks.project_name, file_link, date_of_completion, tasks.project_id FROM tasks 
                JOIN projects ON tasks.project_id = projects.project_id
                WHERE projects.project_id = $project_id";
            } else {
            $sql ="SELECT task_id, name_tasks, tasks.project_name, file_link, date_of_completion FROM tasks";
        }

        $resultTasks = mysqli_query($con, $sql);
           if (!$resultTasks) {
               $error = mysqli_error($con);
               exit('При выполнении запроса возникла ошибка' . $error);
           }  else {
               $tasks = mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);
           }

/*Затем код формирует страницу, используя шаблоны. Сначала создается содержимое страницы (`$page_content`)
с использованием шаблона `main.php`. Это содержимое будет вставлено в макет страницы.*/
$page_content = include_template("main.php",[
"projects" => $projects,
"tasks" => $tasks,
"show_complete_tasks" => $show_complete_tasks,
 "countTasks" => $countTasks,
 "project_id" =>  $project_id
]);

/*Далее, создается макет страницы (`$layout_content`) с использованием шаблона `layout.php`.
В этот макет вставляется содержимое страницы, имя пользователя и заголовок страницы.*/
$layout_content = include_template("layout.php",[
    "content" => $page_content,
    "user_name" => $user_name,
    "title" => "Главная"
]);

//созданный макет выводится на экран с помощью `print`
print ($layout_content);