<?php
//Далее 2 массива: для списка проектов и для списка задач

                $categories = [
                    "incoming" => "Входящие",
                    "studies"  => "Учеба",
                    "job" => "Работа",
                    "housework" => "Домашние дела",
                    "auto"  => "Авто"
                ];

                $tasks = [
                    [
                        "task" => "Собеседование в IT компании",
                        "date_of_completion" => "01.12.2019",
                        "category" => $categories["job"],
                        "status" => false
                    ],
                    [
                        "task" => "Выполнить тестовое задание",
                        "date_of_completion" => "25.12.2019",
                        "category" => $categories["job"],
                        "status" => false
                    ],
                    [
                        "task" => "Сделать задание первого раздела",
                        "date_of_completion" => "21.12.2019",
                        "category" => $categories["studies"],
                        "status" => true
                    ],
                    [
                        "task" => "Встреча с другом",
                        "date_of_completion" => "22.12.2019",
                        "category" => $categories["incoming"],
                        "status" => false
                    ],
                    [
                        "task" => "Купить корм для кота",
                        "date_of_completion" => null,
                        "category" => $categories["housework"],
                        "status" => false
                    ],
                    [
                        "task" => "Заказать пиццу",
                        "date_of_completion" => null,
                        "category" => $categories["housework"],
                        "status" => false
                    ],
                ];
