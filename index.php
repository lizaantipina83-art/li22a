<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №11 — Работа с файлами</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        h1, h2 { color: #5c3443; margin-bottom: 20px; }
        .result { background: #ffe9ed; padding: 12px; margin: 10px 0; border-left: 4px solid #834b59; border-radius: 4px; }
        .success { background: #e6ffe8; border-left-color: #92c28b; }
        .error { background: #ffb8be; border-left-color: #ff939e; }
        pre { background: #cefff7; padding: 12px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>

<?php

// Убедимся, что скрипт может работать с файлами
echo "<h2>Проверка прав доступа</h2>";
if (is_writable('.')) {
    echo "<div class='success'>Текущая папка доступна для записи</div>";
} else {
    echo "<div class='error'>Нет прав на запись в текущую папку!</div>";
}

//часть 1
echo "<h2>Работа с файлами</h2>";

//Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'.
echo "<h>Задание 1</h3>";
$file1 = 'test.txt';
$content1 = 'Привет, мир!';
if (file_put_contents($file1, $content1) !== false) {
    echo "<div class='success'>Файл '$file1' создан и записан: \"$content1\"</div>";
} else {
    echo "<div class='error'>Не удалось создать файл '$file1'</div>";
}

//Считайте данные из файла 'test.txt' и выведите их на экран. 
echo "<h>Задание 2</h3>";
if (file_exists($file1)) {
    $readContent = file_get_contents($file1);
    echo "<div class='result'>Содержимое файла: \"$readContent\"</div>";
} else {
    echo "<div class='error'>Файл '$file1' не найден</div>";
}

//Переименуйте файл 'test.txt' в 'mir.txt'.
echo "<h>Задание 3</h3>";
$newName1 = 'mir.txt';
if (rename($file1, $newName1)) {
    echo "<div class='success'>Файл переименован: '$file1' → '$newName1'</div>";
} else {
    echo "<div class='error'>Не удалось переименовать файл</div>";
}

//Создайте папку 'folder' и  переместите файл 'mir.txt' в эту папку.
echo "<h>Задание 4</h3>";
$folder1 = 'folder';
if (!file_exists($folder1)) {
    if (mkdir($folder1, 0775)) {
        echo "<div class='success'>Папка '$folder1' создана</div>";
    } else {
        echo "<div class='error'>Не удалось создать папку '$folder1'</div>";
    }
}

// Перемещаем файл (переименовываем с указанием нового пути)
$movedFile = "$folder1/$newName1";
if (rename($newName1, $movedFile)) {
    echo "<div class='success'>Файл перемещён в папку: '$movedFile'</div>";
} else {
    echo "<div class='error'>Не удалось переместить файл</div>";
}

//Создайте копию файла 'mir.txt' и назовите ее 'world.txt'. Показать решение.
echo "<h>Задание 5</h3>";
$copyFile = "$folder1/world.txt";
if (copy($movedFile, $copyFile)) {
    echo "<div class='success'>Создана копия: '$copyFile'</div>";
} else {
    echo "<div class='error'>Не удалось создать копию файла</div>";
}

//Определите размер файла 'world.txt'. Выведите его на экран. Выведите его в байтах, мегабайтах, гигабайтах. 
echo "<h>Задание 6</h3>";
if (file_exists($copyFile)) {
    $sizeBytes = filesize($copyFile);
    $sizeMB = $sizeBytes / (1024 * 1024);
    $sizeGB = $sizeBytes / (1024 * 1024 * 1024);
    
    echo "<div class='result'>";
    echo "Размер файла:<br>";
    echo "• Байты: $sizeBytes байт<br>";
    echo "• Мегабайты: " . number_format($sizeMB, 6) . " МБ<br>";
    echo "• Гигабайты: " . number_format($sizeGB, 9) . " ГБ";
    echo "</div>";
} else {
    echo "<div class='error'>Файл '$copyFile' не найден</div>";
}

//Удалите файл 'world.txt'. 
echo "<h>Задание 7</h3>";
if (unlink($copyFile)) {
    echo "<div class='success'>Файл '$copyFile' удалён</div>";
} else {
    echo "<div class='error'>Не удалось удалить файл '$copyFile'</div>";
}

// Проверьте существование файлов 'world.txt' и 'mir.txt'.
echo "<h>Задание 8</h3>";
echo "<div class='result'>";
echo "Файл 'world.txt': " . (file_exists($copyFile) ? 'существует' : 'не существует') . "<br>";
echo "Файл 'mir.txt': " . (file_exists($movedFile) ? 'существует' : 'не существует');
echo "</div>";

//часть 2

echo "<h2>Часть 2: Работа с папками</h2>";

//Создайте папку 'test'.
echo "<h>Задание 1</h3>";
$testFolder = 'test';
if (!file_exists($testFolder)) {
    if (mkdir($testFolder, 0775)) {
        echo "<div class='success'>Папка '$testFolder' создана</div>";
    } else {
        echo "<div class='error'>Не удалось создать папку '$testFolder'</div>";
    }
} else {
    echo "<div class='result'>Папка '$testFolder' уже существует</div>";
}

//Переименуйте папку 'test' на 'www'. 
echo "<h>Задание 2</h3>";
$wwwFolder = 'www';
if (rename($testFolder, $wwwFolder)) {
    echo "<div class='success'>Папка переименована: '$testFolder' → '$wwwFolder'</div>";
} else {
    echo "<div class='error'>Не удалось переименовать папку</div>";
}

//Удалите папку 'www'. 
echo "<h>Задание 3</h3>";
if (rmdir($wwwFolder)) {
    echo "<div class='success'>Папка '$wwwFolder' удалена</div>";
} else {
    echo "<div class='error'>Не удалось удалить папку '$wwwFolder' (возможно, она не пустая)</div>";
}

//Дан массив со строками. Создайте в папке 'test' папки, с названиями которых служат элементы этого массива. 
echo "<h>Задание 4</h3>";
$foldersArray = ['documents', 'images', 'css', 'js', 'uploads'];
$testDir = 'test';

if (!file_exists($testDir)) {
    mkdir($testDir, 0775);
}

foreach ($foldersArray as $folderName) {
    $fullPath = "$testDir/$folderName";
    if (!file_exists($fullPath)) {
        if (mkdir($fullPath, 0775)) {
            echo "<div class='success'>Создана папка: '$fullPath'</div>";
        } else {
            echo "<div class='error'>Не удалось создать папку: '$fullPath'</div>";
        }
    } else {
        echo "<div class='result'>ℹПапка '$fullPath' уже существует</div>";
    }
}

//Выведите все файлы с расширением jpg из текущей папки.
echo "<h>Задание 5</h3>";
$jpgFiles = glob("*.jpg");
if (!empty($jpgFiles)) {
    echo "<div class='result'>Найдены JPG-файлы:<br>";
    foreach ($jpgFiles as $jpg) {
        $size = filesize($jpg);
        echo "• " . basename($jpg) . " (" . $size . " байт)<br>";
    }
    echo "</div>";
} else {
    echo "<div class='result'>В текущей папке нет файлов с расширением .jpg</div>";
}

echo "<h3>Структура папки 'test'</h3>";
if (file_exists($testDir)) {
    $filesInTest = scandir($testDir);
    $foldersOnly = array_filter($filesInTest, function($item) use ($testDir) {
        return $item !== '.' && $item !== '..' && is_dir("$testDir/$item");
    });
    echo "<div class='result'>Папки в '$testDir':<br>" . implode("<br>", $foldersOnly) . "</div>";
}

?>
</body>
</html>