<?php

$parseFunction = function (string $text): array {
    $result = [];

    $patterns = [
        'code' => '/\b(\d{4,6})(?!\s*[,.рp₽\d])/uim',
        'account' => '/\b(4100\d{8,11})\b/m',
        'amount' => '/(\d+[,.]?\d{0,2}?)\s*(?=[рp₽])/uim',
    ];

    foreach ($patterns as $index => $pattern) {
        if (preg_match($pattern, $text, $matches)) {
            $result[$index] = $matches[1];
        }
    }

    return $result;
};

$texts = [
'Пароль 6682  
Спишется 10 p.
Перевод на счет 410011154159557,',

    'Пароль: 66842
Спишется 10111.0р
Перевод на счет 410011154159557',
    '
Пароль: 66842,
Спишется 10,1 р,
Перевод на счет 410011154159557,',
    '
Пароль: 66842,
Спишется 10,1 р.
Перевод на счет 410011154159557.',
    '
Пароль: 66842
Спишется 1234р
Перевод на счет 410011154159557',
    '
Пароль: 66842
Спишется 1234  руб
Перевод на счет 410011154159557',
    'Неверная сумма.',
];

foreach ($texts as $text) {
    $parsed = $parseFunction($text);
    var_dump($parsed);
}