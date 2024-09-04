<?php

return [
    'mails' => [
        'sign-up-notification-subject' => config('app.name') . ' - Sign up notification',
        'rate-was-earned-subject' => config('app.name') . ' - Tariff was earned',
        'update-email-request-subject' => config('app.name') . ' - Request for email update',
        '1-msg' => 'You were sign up on the site ' . config('app.name') . '. Click on the <a href=":link">link</a> to approve your e-mail.',
        'update-email-request-msg' => 'Your e-mail was updated on the site ' . config('app.name') . '. Click on the <a href=":link">link</a> to approve your e-mail update.',
    ],
    'errors' => [
        'user-not-found' => 'User not found.',
        'wrong-hash' => 'Wrong verification. Try again or ask technical support for help.',
        'wrong-timestamp' => 'Token expires or wrong.',
        'route-not-found' => 'Invalid route.',
        'unauthenticated' => 'User is not authenticated.',
        'unauthenticated-wrong-role' => 'User is not authenticated or user is not allowed to this method.',
        'currency-not-found' => 'Currency in request not found.',
        'wrong-role' => 'You are not allowed for this action.',
        'project-not-found' => 'Project was not found.',
        'file-not-found' => 'File was not found.',
        'not-admin' => 'Not enough privileges.',
        'wrong-status' => 'Wrong status.',
        'category-not-found' => 'Category not found.',
        'category-not-empty' => 'Current category is not empty and cannot be deleted.',
        'user-wrong-password' => 'Wrong credentials.',
        'user-already-exists' => 'User with this email already exists.',
        'user-portfolio-no-image' => 'There is no image.',
        'user-portfolio-was-not-found' => 'Portfolio was not found.',
        'ticket-not-found' => 'Support ticket was not found.',
        'ticket-complain-message' => 'Complaint about the project ":project".',
        'not-enough-money' => 'Your balance is too low.',
    ],
    'transactions' => [
        'deposit' => 'Account replenishment.',
        'withdraw' => 'Withdraw.',
        'transfer' => 'Money transfer.',
        'not-found' => 'Transaction not found.',
    ],
    'blog' => [
        'not-found' => 'Blog news not found.',
        'parameter-is-empty' => 'Parameter is empty.',
    ],
    'user' => [
        'not-found' => 'User not found.',
        'wrong-password' => 'Wrong credentials.',
        'already-exists' => 'User with this email already exists.',
        'portfolio-no-image' => 'There is no image.',
        'portfolio-was-not-found' => 'Portfolio was not found.',
    ],
    'notifications' => [
        'common-notification' => 'You received new notification. Please, visit system to view it.',
    ]
];
