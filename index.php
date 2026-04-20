<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №10 — Формы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Форма регистрации</h1>
        
        <!-- Форма регистрации -->
        <form action="action.php" method="post" class="form">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com" required>
            
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" placeholder="Минимум 6 символов" required minlength="6">
            
            <label for="gender">Пол:</label>
            <select id="gender" name="gender" required>
                <option value="">Выберите пол</option>
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
                <option value="other">Другой</option>
            </select>
            
            <button type="submit">Зарегистрироваться</button>
        </form>

        <hr>

        <!-- Калькулятор -->
        <h2>Калькулятор</h2>
        <form method="post" class="calculator" action="">
            <input type="number" name="num1" placeholder="Первое число" step="any" required>
            <select name="operation" required>
                <option value="+">+</option>
                <option value="-">−</option>
                <option value="*">×</option>
                <option value="/">÷</option>
            </select>
            <input type="number" name="num2" placeholder="Второе число" step="any" required>
            
            <button type="submit" name="calc">Вычислить</button>
        </form>

        <?php
        // Обработка калькулятора
        if (isset($_POST['calc'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $op = $_POST['operation'];
            $result = null;
            $error = null;

            if ($op === '/' && $num2 == 0) {
                $error = "Ошибка: деление на ноль!";
            } else {
                switch ($op) {
                    case '+': $result = $num1 + $num2; break;
                    case '-': $result = $num1 - $num2; break;
                    case '*': $result = $num1 * $num2; break;
                    case '/': $result = $num1 / $num2; break;
                }
            }

            if ($error) {
                echo "<div class='error'>$error</div>";
            } elseif ($result !== null) {
                echo "<div class='result'>Результат: $num1 $op $num2 = $result</div>";
            }
        }
        ?>
    </div>
</body>
</html>