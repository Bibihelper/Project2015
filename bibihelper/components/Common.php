<?php

namespace app\components;

use yii\base\Object;

class Common extends Object
{
    const M_WRONG_EMAIL = 'Неверный email.';
    const M_EMAIL_NOT_EXISTS = 'Пользователя с таким E-mail не существует.';
    const M_MIN_PASSWORD_LENGTH = 'Минимальная длина пароля - 6 символов.';
    const M_MAX_PASSWORD_LENGTH = 'Максимальная длина пароля - 32 символа.';
    const M_EMAIL_SEND = 'Вам на почту высланно письмо для подтверждения регистрации.';
    const M_FAILED_SAVE_DATA = 'Не удалось сохранить данные. Повторите попытку позже.';
    const M_LOGIN_FAILED = 'Не удалось произвести вход в систему. Повторите попытку позже.';
    const M_WRONG_PASSWORD = 'Неверный пароль.';
    const M_EMAIL_EXISTS = 'Пользователь с таким E-mail уже существует.';
    const M_PASSWORDS_NOT_MATCH = 'Пароли не совпадают.';
}