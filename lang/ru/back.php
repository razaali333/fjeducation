<?php

return [
    'mails' => [
        'sign-up-notification-subject' => config('app.name') . ' - Уведомление о регистрации',
        'rate-was-earned-subject' => config('app.name') . ' - Тариф был приобретён',
        'update-email-request-subject' => config('app.name') . ' - Запрос на обновление адреса электронной почты',
        '1-msg' => 'Вы зарегистрировались на сайте ' . config('app.name') . '. Пройдите по <a href=":link">ссылке</a>, чтобы подтвердить ваш адрес электронной почты.',
        'update-email-request-msg' => 'Ваш адрес электронной почты был обновлён на сайте ' . config('app.name') . '. Пройдите по <a href=":link">ссылке</a>, чтобы подтвердить изменения адреса.',
    ],
    'errors' => [
        'user-not-found' => 'Пользователь не найден.',
        'wrong-hash' => 'Ошибка проверка. Попробуйте снова или обратитесь в тех. поддержку за помощью.',
        'wrong-timestamp' => 'Срок токена вышел или токен неверен.',
        'route-not-found' => 'Неверный путь.',
        'unauthenticated' => 'Пользователь не авторизован.',
        'unauthenticated-wrong-role' => 'Пользователь не авторизован или недостаточно прав для выполнения действия.',
        'currency-not-found' => 'Выбранная валюта не найден.',
        'wrong-role' => 'Вам не разрешено это действие.',
        'project-not-found' => 'Проект не найден.',
        'file-not-found' => 'Файл не найден.',
        'not-admin' => 'Недостаточно прав.',
        'wrong-status' => 'Статус не верен.',
        'category-not-found' => 'Категория не найдена.',
        'category-not-empty' => 'Выбранная категория не пуста и не может быть удалена.',
        'user-wrong-password' => 'Пара логина и пароля не найдена.',
        'user-already-exists' => 'Пользователь с таким адресом электронной почты уже существует.',
        'user-portfolio-no-image' => 'Изображение отсутствует.',
        'user-portfolio-was-not-found' => 'Портфолио не найдено.',
        'ticket-not-found' => 'Обращение в тех. поддержку не найдено.',
        'ticket-complain-message' => 'Complaint about the project ":project".',
        'not-enough-money' => 'Баланс слишком низок.',
    ],
    'transactions' => [
        'deposit' => 'Пополнение баланса.',
        'withdraw' => 'Вывод средств.',
        'transfer' => 'Оплата проекта.',
    ],
    'blog' => [
        'not-found' => 'Новость не найдена.',
        'parameter-is-empty' => 'Параметр пуст.',
    ],
    'user' => [
        'not-found' => 'Пользователь не найден.',
        'wrong-password' => 'Пара логина и пароля не найдена.',
        'already-exists' => 'Пользователь с таким адресом электронной почты уже существует.',
        'portfolio-no-image' => 'Изображение отсутствует.',
        'portfolio-was-not-found' => 'Портфолио не найдено.',
    ],
    'notifications' => [
        'common-notification' => 'Вы получили новое уведомление. Пожалуйста, посетите систему, чтобы просмотреть его.',
    ]
];
