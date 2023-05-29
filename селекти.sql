--Запит SQL з використанням JOIN для об'єднання таблиць flight і flight_type--

SELECT f.*, (SELECT name FROM flight_type WHERE id = f.type_id) AS flight_type_name
        FROM flight f
        WHERE f.user_id = '
-- вибір всіх стовпців з таблиці fligt_type--

 SELECT * FROM flight_type
--вибір всіх стовпців з таблиці users для перевірки чи існує користувач з таким логіном--

SELECT * FROM users WHERE login = '

--запит на видалення даних з таблиці fligt--

DELETE FROM flight WHERE id = '

--поновлення статусу--
UPDATE `flight` SET `status`='1' WHERE `id`=?

--Запит SQL з використанням JOIN для об'єднання таблиць flight і flight_type--

SELECT f.*, u.phone AS user_phone, u.name AS user_name, ft.name AS flight_type_name
                FROM flight f
                JOIN users u ON f.user_id = u.id
                JOIN flight_type ft ON f.type_id = ft.id
                
                --селект для вставки нового користувача в базу даних--

                INSERT INTO users (login, name, surname, phone, password) VALUES ('". $login ."', '". $name ."', '". $surname ."', '". $phone ."', '". $password ."')
                
                