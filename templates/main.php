

                <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>
                <nav class="main-navigation">
                    <!-- здесь с помощью цикла foreach заполняем список проектов из массива $categories -->
                    <ul class="main-navigation__list">
                    <?php foreach ($projects as $project): ?>
                        <li class="main-navigation__list-item--<?=$project["character_code"];?>
                        <?php if  ((int)$project_id == (int)$project['project_id']): ?> main-navigation__list-item--active <?php endif ?>">
                            <a class="main-navigation__list-item-link" href="index.php?project_id=<?= $project['project_id']; ?>"><?= htmlspecialchars($project["project_name"]); ?></a>
                            <span class="main-navigation__list-item-count"><?= count_tasks($countTasks,$project["project_name"]); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox"
                               <?php if ($show_complete_tasks): ?>checked<?php endif; ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>
                <!-- здесь заменяем все содержимое этой таблицы данными из массива задач $tasks. Если у задачи статус
                «выполнен», то строке с этой задачей добавить класс "task--completed" -->
                <table class="tasks">
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task["status"]&&$show_complete_tasks==0): continue; ?>
                        <?php else: ?>
                    <!-- Вводим массив с функцией подсчета оставшихся часов до окончания задачи -->
                            <?php $res = get_time_left(htmlspecialchars($task["date_of_completion"])) ?>
                            <tr class="tasks__item task <?php if ($task["status"]): ?>task--completed<?php endif; ?>
                              <?php if ($res[2] <= 24 || $res[2] = 0) : ?>task--important<?php endif; ?>">
                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                        <span class="checkbox__text"><?= htmlspecialchars($task["name_tasks"]);?></span>
                                    </label>
                                </td>
                                <td class="task__file">
                                    <a class="download-link" href="#"><?= htmlspecialchars($task["file_link"]);?></a>
                                </td>
                                <td class="task__date">
                                    <?= $task["date_of_completion"]; ?></td>
                                <td class="task__controls">
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <!--показывать следующий тег <tr>, если переменная $show_complete_tasks равна единице-->
                    <?php if($show_complete_tasks): ?>
                        <tr class="tasks__item task task--completed">
                            <td class="task__select">
                                <label class="checkbox task__checkbox">
                                    <input class="checkbox__input visually-hidden" type="checkbox" checked>
                                    <span class="checkbox__text">Записаться на интенсив "Базовый PHP"</span>
                                </label>
                            </td>
                            <td class="task__date">10.10.2019</td>
                            <td class="task__controls">
                            </td>
                        </tr>
                    <?php endif; ?>

                </table>
            </main>