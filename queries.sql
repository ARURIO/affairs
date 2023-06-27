INSERT INTO users ( email, user_name, user_password)
VALUES
    ('hero34@mail.ru', 'Ярослав', 'secretpassw1'),
    ('asis174@mail.ru', 'Слава', 'secretpassw2');

INSERT INTO categories (character_code, name_category, id_users)
VALUES
    ('incoming', 'Входящие', 1),
    ('studies', 'Учеба', 1),
    ('job', 'Работа', 1),
    ('housework', 'Домашние дела', 2),
    ('auto', 'Авто', 2);

INSERT INTO tasks (status, name_tasks, file_link, date_of_completion, id_users, id_categories)
VALUES
    (0, 'Собеседование в IT компанию', 'files/30034.pdf', '2023-07-01', 1, 3),
    (0, 'Выполнить тестовое задание', 'files/30034.pdf', '2023-12-25', 1, 3),
    (1, 'Сделать задание первого раздела', 'files/3012.pdf', '2023-07-21', 1, 2),
    (0,'Встреча с другом', null, '2023-07-13', 2, 1),
    (0,'Купить корм для кота', 'files/100.gif', null, 2, 4),
    (0, 'Заказать пиццу', 'files/274.png', null, 2, 4);


--Получаем список из всех проектов для одного пользователя
SELECT name_category FROM categories WHERE id_users=1;

--Получить список из всех задач для одного проекта
SELECT name_tasks FROM tasks WHERE id_categories=3;

--Пометить задачу как выполнененную
UPDATE tasks SET status=1 WHERE name_tasks='Собеседование в IT компанию';

--Обновить название задачи по ее идентификатору
UPDATE tasks SET name_tasks='Встреча с любовницей' WHERE id_tasks=4;