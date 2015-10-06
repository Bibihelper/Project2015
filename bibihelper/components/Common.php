<?php

namespace app\components;

use yii\base\Object;

class Common extends Object
{
    const M_WRONG_EMAIL = 'Неверный email';
    const M_EMAIL_NOT_EXISTS = 'Пользователя с таким E-mail не существует';
    const M_EMAIL_NOT_CONFIRMED = 'E-mail не подтвержден';
    const M_MIN_PASSWORD_LENGTH = 'Минимальная длина пароля - 6 символов';
    const M_MAX_PASSWORD_LENGTH = 'Максимальная длина пароля - 32 символа';
    const M_EMAIL_SEND = 'Вам на почту высланно письмо для подтверждения регистрации';
    const M_FAILED_SAVE_DATA = 'Не удалось сохранить данные. Повторите попытку позже';
    const M_LOGIN_FAILED = 'Не удалось произвести вход в систему. Повторите попытку позже';
    const M_WRONG_PASSWORD = 'Неверный пароль';
    const M_EMAIL_EXISTS = 'Пользователь с таким E-mail уже существует';
    const M_PASSWORDS_NOT_MATCH = 'Пароли не совпадают';
    const M_DATA_SAVE_FAILED = 'Не удалось сохранить данные';
    const M_FIELD_CANNOT_BE_BLANK = 'Поле не может быть пустым';
    const M_CHANGE_PASSWORD_FAILED = 'Не удалось изменить пароль';
    const M_PASSWORD_CHANGED = 'Пароль изменен';
    const M_CHANGE_EMAIL_FAILED = 'Не удалось изменить E-mail';
    const M_EMAIL_CHANGED = 'E-mail изменен';
    const M_FIELD_MAX_LENGTH_32 = 'Максимальная длина 32 символа';
    const M_FIELD_MAX_LENGTH_255 = 'Максимальная длина 255 символов';
    const M_FIELD_MAX_LENGTH_50 = 'Максимальная длина 50 символов';
    const M_FIELD_MAX_LENGTH_10 = 'Максимальная длина 10 символов';
    const M_PHONE_NOT_MATCH_PATTERN = 'Телефон должен соответствовать шаблону - +7 (XXX) XXX-XX-XX';
    const M_FIELD_NOT_MATCH_PATTERN = 'Допустим ввод символов руссокго и латинского алфавитов и знаков: . _ - "" @';
    const M_PSW_EMAIL_SEND = 'Вам на почту высланно письмо для восстановления пароля';
    const M_PSW_RESTORE_SUCCESS = 'Вы можете зайти в ЛК используя новый пароль';
    
    public static function transl($text) 
    { 
        $trans = array( 
            "а" => "a", 
            "б" => "b", 
            "в" => "v", 
            "г" => "g", 
            "д" => "d", 
            "е" => "e", 
            "ё" => "e", 
            "ж" => "zh", 
            "з" => "z", 
            "и" => "i", 
            "й" => "y", 
            "к" => "k", 
            "л" => "l", 
            "м" => "m", 
            "н" => "n", 
            "о" => "o", 
            "п" => "p", 
            "р" => "r", 
            "с" => "s", 
            "т" => "t", 
            "у" => "u", 
            "ф" => "f", 
            "х" => "kh", 
            "ц" => "ts", 
            "ч" => "ch", 
            "ш" => "sh", 
            "щ" => "shch", 
            "ы" => "y", 
            "э" => "e", 
            "ю" => "yu", 
            "я" => "ya", 
            "А" => "A", 
            "Б" => "B", 
            "В" => "V", 
            "Г" => "G", 
            "Д" => "D", 
            "Е" => "E", 
            "Ё" => "E", 
            "Ж" => "Zh", 
            "З" => "Z", 
            "И" => "I", 
            "Й" => "Y", 
            "К" => "K", 
            "Л" => "L", 
            "М" => "M", 
            "Н" => "N", 
            "О" => "O", 
            "П" => "P", 
            "Р" => "R", 
            "С" => "S", 
            "Т" => "T", 
            "У" => "U", 
            "Ф" => "F", 
            "Х" => "Kh", 
            "Ц" => "Ts", 
            "Ч" => "Ch", 
            "Ш" => "Sh", 
            "Щ" => "Shch", 
            "Ы" => "Y", 
            "Э" => "E", 
            "Ю" => "Yu", 
            "Я" => "Ya", 
            "Ъ" => "", 
            "ъ" => "", 
            "ь" => "", 
            "Ь" => "" 
        ); 
        
        if(preg_match("/[А-Яа-яa-zA-Z\.]/", $text)) { 
            return strtr($text, $trans);
        } else { 
            return $text;                  
        } 
    }
}
