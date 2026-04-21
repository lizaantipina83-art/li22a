<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №12 — Исключения и даты</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        h1, h2, h3 { color: #6d363f; margin-bottom: 20px; }
        .result { background: #fcdafc; padding: 12px; margin: 10px 0; border-left: 4px solid #f383c4; border-radius: 4px; }
        .error { background: #f8d7da; border-left-color: #dc3545; }
        .success { background: #d4edda; border-left-color: #28a745; }
        pre { background: #f8f9fa; padding: 12px; border-radius: 5px; overflow-x: auto; }
        form { margin: 20px 0; padding: 15px; background: white; border-radius: 8px; }
        input { padding: 8px; margin: 5px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 15px; background: #f8b6d7; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

<?php

// часть 1
echo "<h2>Часть 1</h2>";

//Напишите обработчик для обработки ошибки открытия несуществующего файла (fopen).
echo "<h3>Задание 1</h3>";
try {
    $file = fopen("nonexistent.txt", "r");
    if ($file === false) {
        throw new Exception("Не удалось открыть файл 'nonexistent.txt'");
    }
    fclose($file);
} catch (Exception $e) {
    echo "<div class='error'>Исключение: " . $e->getMessage() . "</div>";
}

//Напишите обработчик исключения для операции деления на ноль и сохраните сообщение об ошибке в файл log.txt
echo "<h3>Задание 2</h3>";
function divide($a, $b) {
    if ($b == 0) {
        throw new Exception("Деление на ноль запрещено!");
    }
    return $a / $b;
}

try {
    $result = divide(10, 0);
    echo "<div class='success'>Результат: $result</div>";
} catch (Exception $e) {
    $errorMsg = "Ошибка: " . $e->getMessage() . " (Файл: " . basename($e->getFile()) . ", строка: " . $e->getLine() . ")\n";
    file_put_contents("log.txt", $errorMsg, FILE_APPEND);
    echo "<div class='error'>" . $e->getMessage() . "</div>";
    echo "<div class='result'>Сообщение об ошибке сохранено в файл log.txt</div>";
}

//Напишите обработчик исключения для доступа к несуществующему элементу внутри массива. Например, исходный массив $countries =  [‘Spain’ => ‘Madrid’,’Russia’ => ‘Moscow’] и пример запроса $countries[‘Germany’]
echo "<h3>Задание 3</h3>";
$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];

$country = 'Germany';
try {
    if (!isset($countries[$country])) {
        throw new Exception("Страна '$country' не найдена в массиве");
    }
    echo "<div class='success'>Столица $country: " . $countries[$country] . "</div>";
} catch (Exception $e) {
    echo "<div class='error'>Исключение: " . $e->getMessage() . "</div>";
}

// часть 2
echo "<h2>Часть 2</h2>";

//Выведите 15 марта 2025 года, 10:25:00 в формате timestamp. 
echo "<h3>Задание 1</h3>";
$timestamp1 = mktime(10, 25, 0, 3, 15, 2025);
echo "<div class='result'>Timestamp: $timestamp1</div>";

//Найдите разницу между 2 октября 1990 года, 08:05:59 и текущим 	моментом времени в секундах. 
echo "<h3>Задание 2</h3>";
$pastTimestamp = mktime(8, 5, 59, 10, 2, 1990);
$currentTimestamp = time();
$difference = $currentTimestamp - $pastTimestamp;
echo "<div class='result'>Прошло секунд: " . number_format($difference, 0, '.', ' ') . "</div>";

//Выведите текущую дату-время в формате 'Год.месяц.день Час:Минута:Секунда'. 
echo "<h3>Задание 3</h3>";
echo "<div class='result'>Текущее время: " . date('Y.m.d H:i:s') . "</div>";

//Выведите 1-го сентября текущего года в формате 'Год.месяц.день'
echo "<h3>Задание 4</h3>";
echo "<div class='result'>1 сентября: " . date('Y.m.d', mktime(0, 0, 0, 9, 1)) . "</div>";

//Узнайте, какой день недели (словом) был 2 февраля 2000 года.
echo "<h3>Задание 5</h3>";
$weekDays = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
$dayOfWeekNum = date('w', mktime(0, 0, 0, 2, 2, 2000));
echo "<div class='result'>2 февраля 2000 года был: " . $weekDays[$dayOfWeekNum] . "</div>";

//Создайте массив индексов дней недели $week. Выведите на экран название текущего дня недели с помощью массива $week и функции date. Узнайте какой день недели был 12.06.2016, в ваш день рождения. 
echo "<h3>Задание 6</h3>";
echo "<div class='result'>Сегодня: " . $weekDays[date('w')] . "</div>";
$birthdayDay = date('w', mktime(0, 0, 0, 6, 12, 2016)); // 12.06.2016
echo "<div class='result'>12 июня 2016 года был: " . $weekDays[$birthdayDay] . "</div>";

//Сделайте форму, которая спрашивает две даты в формате '2025-12-31'. Первую дату запишите в переменную $date1, а вторую в $date2. Сравните, какая из введенных дат больше. Выведите ее на экран.
echo "<h3>Задание 7</h3>";
if ($_POST && isset($_POST['date1']) && isset($_POST['date2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    
    if (strtotime($date1) > strtotime($date2)) {
        echo "<div class='success'>Большая дата: $date1</div>";
    } else {
        echo "<div class='success'>Большая дата: $date2</div>";
    }
}

echo '<form method="post">';
echo '<label>Дата 1: <input type="date" name="date1" required></label>';
echo '<label>Дата 2: <input type="date" name="date2" required></label>';
echo '<button type="submit">Сравнить</button>';
echo '</form>';

//Дана дата в формате 'Год-месяц-день'. С помощью функции strtotime и функции date преобразуйте ее в формат 'день-месяц-год'. 
echo "<h3>Задание 8</h3>";
$originalDate = '2025-12-31';
$newDate = date('d-m-Y', strtotime($originalDate));
echo "<div class='result'>Исходная: $originalDate → Новая: $newDate</div>";

//В переменной $date лежит дата  '2000.02.03'. Прибавьте к этой дате 2 дня, 1 месяц и 3 дня, 1 год. Отнимите от этой даты 3 дня. 	
echo "<h3>Задание 9</h3>";
$dateStr = '2000.02.03';
$dateObj = date_create(str_replace('.', '-', $dateStr));

// Прибавить 2 дня, 1 месяц и 3 дня, 1 год
date_modify($dateObj, '+2 days');
echo "<div class='result'>+2 дня: " . date_format($dateObj, 'Y.m.d') . "</div>";

date_modify($dateObj, '+1 month +3 days');
echo "<div class='result'>+1 месяц и 3 дня: " . date_format($dateObj, 'Y.m.d') . "</div>";

date_modify($dateObj, '+1 year');
echo "<div class='result'>+1 год: " . date_format($dateObj, 'Y.m.d') . "</div>";

// Отнять 3 дня
date_modify($dateObj, '-3 days');
echo "<div class='result'>-3 дня: " . date_format($dateObj, 'Y.m.d') . "</div>";

//Узнайте сколько дней осталось до Нового Года
echo "<h3>Задание 10</h3>";
$now = time();
$nextYear = date('Y') + 1;
$newYear = mktime(0, 0, 0, 1, 1, $nextYear);
$daysToNY = ceil(($newYear - $now) / (60 * 60 * 24));
echo "<div class='result'>До Нового " . $nextYear . " года осталось: $daysToNY дней</div>";

?>
</body>
</html>