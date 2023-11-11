<div class="content">
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
            <ul class="main-navigation__list">
                <?php foreach ($allProjects as $project): ?>
                    <li class="main-navigation__list-item--<?= $project["character_code"]; ?>
                        <?php if ((int)$project_id == (int)$project['project_id']): ?> main-navigation__list-item--active <?php endif ?>">
                        <a class="main-navigation__list-item-link"
                           href="index.php?project_id=<?= $project['project_id']; ?>"><?= htmlspecialchars($project["project_name"]); ?></a>
                        <span class="main-navigation__list-item-count"><?= count_tasks($allTasks, $project["project_name"]); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить
            проект</a>
    </section>
    <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form" action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">

            <div class=" form__row">
                <?php $classname = isset($errors["name"]) ? "form__input--error" : ""; ?>
                <label class="form__label" for="name">Название <sup>*</sup></label>

                <input class="form__input <?= $classname; ?>" type="text" name="name" id="name"
                       value="<?= $task['name']; ?>" placeholder="Введите название">
                <p class="form__message"><?= $errors['name'] ?? ""; ?></p>
            </div>

            <div class="form__row">
                <?php $classname = (isset($errors['project'])) ? " form__input--error" : ""; ?>
                <label class="form__label" for="project">Проект <sup>*</sup></label>
                <?php $classname = (isset($errors['project_id'])) ? " form__input--error" : ""; ?>
                <select class="form__input form__input--select <?= $classname; ?>" name="project_id" id="project">
                    <?php foreach ($allProjects as $project) : ?>
                        <option value="<?= $project['project_id']; ?>" <?= ($task['project_id'] == $project['project_id']) ? "selected" : ""; ?>><?= htmlspecialchars($project['project_name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="form__message"><?= $errors['project_id'] ?? ""; ?></p>
            </div>

            <div class="form__row">
                <?php $classname = isset($errors['date']) ? " form__input--error" : ""; ?>
                <label class="form__label" for="date">Дата выполнения</label>

                <input class="form__input form__input--date <?= $classname; ?>" type="text" name="date" id="date"
                       value="<?= $task['date']; ?>"
                       placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                <p class="form__message"><?= $errors['date'] ?? ""; ?></p>
            </div>

            <div class="form__row">
                <label class="form__label" for="file">Файл</label>
                <?php $classname = isset($errors['file']) ? " form__input--error" : ""; ?>
                <div class="form__input-file">
                    <input class="visually-hidden" type="file" name="file" id="file" value="">

                    <label class="button button--transparent" for="file">
                        <span>Выберите файл</span>
                    </label>
                    <p class="form__message"><?= $errors['file'] ?? ""; ?></p>
                </div>
            </div>

            <div class="form__row form__row--controls">
                <input class="button" type="submit" name="" value="Добавить">
            </div>
        </form>
    </main>
</div>
