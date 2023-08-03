<?php
require_once("helpers.php");
require_once("functions.php");
require_once("data.php");
require_once ("init.php");

if (!$con) {
    $error = mysqli_connect_error();
}  else {
    $sql = "SELECT character_code, name_category FROM categories WHERE id_users = 1";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

    } else {
        $error = mysqli_error($con);
    }
}

$sql = "SELECT status, name_tasks, file_link, date_of_completion FROM tasks WHERE id_users = 1";

$result_1 = mysqli_query($con, $sql);
if ($result_1) {
    $tasks = mysqli_fetch_all($result_1, MYSQLI_ASSOC);

} else {
    $error = mysqli_error($con);
}

$sql = "SELECT user_name FROM users WHERE id_users = 1";

$result_2 = mysqli_query($con, $sql);
if ($result_2) {
    $user_name = mysqli_fetch_assoc($result_2);
} else {
    $error = mysqli_error($con);
}

$page_content = include_template("main.php",[
"categories" => $categories,
"tasks" => $tasks,
"show_complete_tasks" => $show_complete_tasks,
]);

$layout_content = include_template("layout.php",[
    "content" => $page_content,
    "user_name" => $user_name,
    "title" => "Главная"
]);

print ($layout_content);