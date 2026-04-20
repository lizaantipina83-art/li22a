<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат регистрации</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Результат регистрации</h1>

        <?php
        // Проверка, что форма отправлена методом POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получаем данные из формы
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $gender = $_POST['gender'] ?? '';

            // Валидация обязательных полей
            if (empty($email) || empty($password)) {
                echo "<div class='error'>Ошибка: поля Email и Пароль обязательны для заполнения!</div>";
                echo '<p><a href="javascript:history.back()">← Вернуться назад</a></p>';
            } else {
                // Успешная регистрация
                echo "<div class='success'>✅ Регистрация успешно завершена!</div>";
                echo "<div class='info'>";
                echo "<p><strong>Имя:</strong> " . htmlspecialchars($name) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
                echo "<p><strong>Пол:</strong> " . 
                   $genderText = ($gender === 'male') 
                        ? 'Мужской' 
                        : (($gender === 'female') ? 'Женский' : 'Другой');
                          
                echo "</div>";
                echo '<p><a href="index.php">← Вернуться на главную</a></p>';
                }
            } else {
            echo "<div class='error'>Форма не была отправлена.</div>";
            echo '<p><a href="index.php">← Вернуться на главную</a></p>';
        }
        ?>
    </div>
</body>
</html>