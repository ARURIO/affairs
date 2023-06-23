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
    (0, 'Собеседование в IT компанию', 'files/30034.pdf', '2023-', 1, 3),
    (0, 'Выполнить тестовое задание', 'files/30034.pdf', '25-12-2023', 0, 3),
    (1, 'Сделать задание первого раздела', 'files/3012.pdf', '21-07-2023', 1, 2),
    (0,'Встреча с другом', null, '13-07-2023', 2, 1),
    (0,'Купить корм для кота', 'files/100.gif', null, 2, 4),
    (0, 'Заказать пиццу', 'files/274.png', null, 2, 4);
