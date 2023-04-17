<?php
//функция, которая умеет подсчитывать количество задач в каждом проекте

                function count_tasks ($tasks,$category) {
                    $count=0;
                    foreach ($tasks as $task) {
                        if ($task["category"]==$category) {
                            $count+=1;
                        }
                    }
                    return $count;
                }
//функция, которая рандомно показывает выполнена задача или нет
                $show_complete_tasks = rand(0, 1);
