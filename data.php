<?php
//Далее 2 массива: для списка проектов и для списка задач

                $projects = [
                    "incoming" => "Входящие",
                    "studies"  => "Учеба",
                    "job" => "Работа",
                    "housework" => "Домашние дела",
                    "auto"  => "Авто"
                ];

                $tasks = [
                    [
                        "task" => "Собеседование в IT компании",
                        "date_of_completion" => "01.07.2023",
                        "project_name" => $projects["job"],
                        "status" => false
                    ],
                    [
                        "task" => "Выполнить тестовое задание",
                        "date_of_completion" => "25.12.2023",
                        "project_name" => $projects["job"],
                        "status" => false
                    ],
                    [
                        "task" => "Сделать задание первого раздела",
                        "date_of_completion" => "21.07.2023",
                        "project_name" => $projects["studies"],
                        "status" => true
                    ],
                    [
                        "task" => "Встреча с другом",
                        "date_of_completion" => "13.07.2023",
                        "project_name" => $projects["incoming"],
                        "status" => false
                    ],
                    [
                        "task" => "Купить корм для кота",
                        "date_of_completion" => null,
                        "project_name" => $projects["housework"],
                        "status" => false
                    ],
                    [
                        "task" => "Заказать пиццу",
                        "date_of_completion" => null,
                        "project_name" => $projects["housework"],
                        "status" => false
                    ],
                ];
