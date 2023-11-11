<?php
/* Подсчитывать количество задач в каждом проекте
 *@param array $tasks, string название проекта
 *@return integer число задач для переданного проекта
 */
function count_tasks ($allTasks,$project) {
    $count=0;
    foreach ($allTasks as $allTask) {
        if ($allTask["project_name"]==$project) {
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

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form (int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}


/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */

function db_get_prepare_stmt($con, $sql, $data = []) {
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Возвращает массив из объекта результата запроса
 * @param object $result_query mysqli Результат запроса к базе данных
 * @return array
 */
function get_arrow ($result_query) {
    $row = mysqli_num_rows($result_query);
    if ($row === 1) {
        $arrow = mysqli_fetch_assoc($result_query);
    } else if ($row > 1) {
        $arrow = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
    }

    return $arrow;
}

/**
 * Получает и фильтрует значение из массива POST по имени поля.
 *
 * Эта функция принимает имя поля формы, и, если оно существует в массиве POST,
 * извлекает его значение и применяет фильтрацию для безопасности.
 *
 * @param string $name Имя поля формы.
 *
 * @return mixed|null Возвращает значение поля из массива POST, если оно существует,
 *                   или null, если поле отсутствует.
 */
function get_post_val($name) {
    return filter_input(INPUT_POST, $name);
}
