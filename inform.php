<?php
/*
В продолжении нашего разговора в скайпе, отправляю тестовое задание:

Необходимо, на чистом PHP, реализовать публичный мини-блог,  в котором любой гость может создавать записи, а другие гости имеют право комментировать записи. Авторизация не нужна.

В функционале обязаны присутствовать две страницы: список последних записей и одна запись.

На странице списка последних записей выводится слайдер “популярное” из 5 самых коментируемых записей. Ниже - записи в порядке давности публикации, которые должны содержать имя автора, короткий текст публикации(обрезка 100 символов), дату публикации, количество комментариев и ссылку для перехода на полную запись. Так же на этой странице должна находиться форма для отправки публикации, в которой указываются имя пользователя и текст публикации.

На странице полной публикации выводится всё то же, что и в короткой публикации, только текст публикации должен быть полным, а так же комментарии к этой публикации и форма добавления нового комментария в котором указывается имя автора и текст публикации.

Выбор способа хранения информации и визуальной составляющей на усмотрение кандидата.

Предоставить задание в открытом репозитории, с доступной документацией по установке и настройке. 

Срок выполнения 5 дней. 
Удачи )

Будут возникать вопросы - обращайтесь!

Наталья, HR manager
S: recruiter_v-jet
L: https://ua.linkedin.com/in/nataliazhogova 
E: vjet.hr@gmail.com
T: 096−15−33333
----------------------------------------------

Блог использует SQLite базу данных и интерфейс Data Objects (PDO). Нужно чтобы были подключены соответсвующие расширения 
и драйвера. База данных уже имеет данные. Для обновления блога нужно удалить, переменовать файл в папке database или в 
конфигурационнном файле сменить название. Также в этом файле можно менять название и автора блога.
------------------------------------------------
Замечание: К сожалению, есть ошибки
проблема c htacсess
нет проверки на xss
пустые записи в базе (пробелы)
нет .git
+ пришлось постаратся чтоб запустить
------------------------------------------------
Получил тестовое задание от компании Смартспорт 

Необходимо, на чистом PHP, реализовать публичный мини-блог,  в котором любой гость может создавать записи, а другие гости имеют право комментировать записи. Авторизация не нужна.

В функционале обязаны присутствовать две страницы: список последних записей и одна запись.

На странице списка последних записей выводится слайдер “популярное” из 5 самых комментируемых записей. Ниже - записи в порядке давности публикации, которые должны содержать имя автора, короткий текст публикации(обрезка 100 символов), дату публикации, количество комментариев и ссылку для перехода на полную запись. Так же на этой странице должна находиться форма для отправки публикации, в которой указываются имя пользователя и текст публикации.

На странице полной публикации выводится всё то же, что и в короткой публикации, только текст публикации должен быть полным, а так же комментарии к этой публикации и форма добавления нового комментария в котором указывается имя автора и текст публикации.

Выбор способа хранения информации и визуальной составляющей на усмотрение кандидата.

Предоставить задание в открытом репозитории, с доступной документацией по установке и настройке. 

Срок выполнения 5 дней.
*/
?>