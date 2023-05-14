<?php
 /* Подсчитывать количество задач в каждом проекте
 *@param array $tasks, string название проекта
 *@return integer число задач для переданного проекта
 */
function count_tasks ($tasks,$category) {
                    $count=0;
                    foreach ($tasks as $task) {
                        if ($task["category"]==$category) {
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
