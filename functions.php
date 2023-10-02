<?php
 /* Подсчитывать количество задач в каждом проекте
 *@param array $tasks, string название проекта
 *@return integer число задач для переданного проекта
 */
function count_tasks ($countTasks,$project) {
                    $count=0;
                    foreach ($countTasks as $countTask) {
                        if ($countTask["project_name"]==$project) {
                            $count+=1;
                        }
                    }
                    return $count;
                }


// Рандомно показывает выполнена задача или нет
                $show_complete_tasks = rand(0, 1);


/* Возвращает количество оставшихся часов до каждой из  дат выполнения задачи
 *@param string $data дата выполнения задачи
 * @return array
  */
function get_time_left($date) {
    date_default_timezone_set ('Europe/Moscow');
    $final_date = date_create($date);
    $cur_date = date_create("now");
    $diff = date_diff($cur_date, $final_date);
    $format_diff = date_interval_format($diff, "%d %H %I");
    $arr = explode(" ", $format_diff);

    $days = $arr[0];
    $hours = $arr[1];
    $total_hours = $arr[0] * 24 + $arr[1];
    $days = str_pad($days, 2, "0", STR_PAD_LEFT);
    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $res[] = $days;
    $res[] = $hours;
    $res[] = $total_hours;
    if ($final_date < $cur_date){
        $res[2] = 0;
    }
    return $res;
}

/*Проверяет существование проекта в базе данных
 *@param  integer $project_id идентификатор проекта, который извлекается из параметра запроса
 * @return true или false
 */
function projectExists($project_id, $con) {
          //Используем подготовленный запрос для безопасности
             $sql = "SELECT COUNT(*) FROM projects WHERE project_id = ?";
              //Создаем подготовленное выражение
             $stmt = mysqli_prepare($con, $sql);
             if($stmt) {
                    //Привязываем значение project_id к подготовленному выражению
                      mysqli_stmt_bind_param($stmt,"i",$project_id);
                    //выполняем запрос
                    mysqli_stmt_execute($stmt);
                    // Связывание результатов запроса с переменными
                    mysqli_stmt_bind_result($stmt,$countProj);
                    // Извлечение данных
                    mysqli_stmt_fetch($stmt);
                    // Если найдена хотя бы одно совпадение, возвращает true, иначе false
                        return $countProj > 0;
             }  else {
                  //Обработка ошибки подготовленного запроса
                  return false;
             }
}


