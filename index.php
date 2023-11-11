<?php
//В начале скрипта подключаются необходимые файлы
require_once ("functions/db.php");
require_once ("functions/helpers.php");
require_once ("functions/models.php");
require_once ("functions/validators.php");
require_once ("functions/template.php");

$allProjects = getAllProjects($con);
$allTasks = getAllTasks($con);
$project_id = checkProjectParameter($con);
$tasksOfProjects = getTaskOfProjects($con, $project_id);






/*Затем код формирует страницу, используя шаблоны. Сначала создается содержимое страницы (`$page_content`)
с использованием шаблона `main.php`. Это содержимое будет вставлено в макет страницы.*/
$page_content = include_template("main.php", [
    "allProjects" => $allProjects,
    "allTasks" => $allTasks,
    "show_complete_tasks" => $show_complete_tasks,
    "tasksOfProjects" => $tasksOfProjects,
    "project_id" => $project_id
]);

/*Далее, создается макет страницы (`$layout_content`) с использованием шаблона `layout.php`.
В этот макет вставляется содержимое страницы, имя пользователя и заголовок страницы.*/
$layout_content = include_template("layout.php", [
    "content" => $page_content,
    "user_name" => $user_name,
    "title" => "Главная"
]);

//созданный макет выводится на экран с помощью `print`
print ($layout_content);
