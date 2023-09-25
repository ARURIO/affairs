USE affairs;
INSERT INTO users ( email, user_name, user_password)
VALUES
    ('hero34@mail.ru', 'Ярослав', 'secretpassw1'),
    ('asis174@mail.ru', 'Слава', 'secretpassw2');

INSERT INTO projects (character_code, project_name, user_id)
VALUES
    ('incoming', 'Входящие', 1),
    ('studies', 'Учеба', 1),
    ('job', 'Работа', 1),
    ('housework', 'Домашние дела', 2),
    ('auto', 'Авто', 2);

INSERT INTO tasks (status, name_tasks, project_name, file_link, date_of_completion, user_id, project_id)
VALUES
    (0, 'Собеседование в IT компанию', 'работа','files/30034.pdf', '2023-07-01', 1, 3),
    (0, 'Выполнить тестовое задание','работа','files/30034.pdf', '2023-12-25', 1, 3),
    (1, 'Сделать задание первого раздела','Учеба', 'files/3012.pdf', '2023-07-21', 1, 2),
    (0,'Встреча с другом','Входящие', null, '2023-07-13', 2, 1),
    (0,'Купить корм для кота','Домашние дела', 'files/100.gif', null, 2, 4),
    (0, 'Заказать пиццу','Домашние дела', 'files/274.png', null, 2, 4),
    (0,'Помыть машину','Авто', 'files/101.gif', null, 2, 5);

--Получаем список из всех проектов для одного пользователя
SELECT project_name FROM projects WHERE user_id=1;

--Получить список из всех задач для одного проекта
SELECT name_tasks FROM tasks WHERE project_id=3;

--Пометить задачу как выполнененную
UPDATE tasks SET status=1 WHERE name_tasks='Собеседование в IT компанию';

--Обновить название задачи по ее идентификатору
UPDATE tasks SET name_tasks='Встреча с любовницей' WHERE task_id=4;