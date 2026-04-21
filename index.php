<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №13 — Объекты в PHP</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        h1, h2, h3 { color: #49222b; margin-bottom: 20px; }
        .result { background: #ffc1d6; padding: 12px; margin: 10px 0; border-left: 4px solid #751f1f; border-radius: 4px; }
        .success { background: #d4edda; border-left-color: #28a745; }
        .error { background: rgb(255, 168, 175); border-left-color: #dc3545; }
        pre { background: #f8f9fa; padding: 12px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>

<?php

//Создайте класс Название_свое(работник), в котором будут следующие свойства:
// name (имя), 
// age (возраст),
// salary (зарплата).
// Создайте 2 объекта класса Название_свое(работник), затем установите  свойства своими значениями в каждом объекте, которые вы только что создали.

class Worker {
    // Свойства класса
    public $name;
    public $age;
    private $salary;

    // Конструктор класса
    public function __construct($name, $age, $salary) {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    //Сделайте в классе Название_свое(работник) метод getName, который будет возвращать имя работника.
    public function getName() {
        return $this->name;
    }

     //Сделайте в классе Название_свое(работник)  метод getAge, который будет возвращать возраст работника.
    public function getAge() {
        return $this->age;
    }

    //Сделайте в классе Название_свое(работник)  метод getSalary, который будет возвращать зарплату работника.Выведете на экран работу метода.
    public function getSalary() {
        return $this->salary;
    }

    //Измените getAge в классе Название_свое(работник) на метод setAge, который параметром будет принимать новый возраст пользователя, а свойство age сделайте скрытым.
    //Внесите изменения в метод setAge так, чтобы он вначале проверял, что переданный возраст больше или равен 18. Если это так - пусть метод меняет возраст пользователя, а если не так - выводил что “Вам работать в нашей компании еще рано”.
    public function setAge($newAge) {
        $this->checkAge($newAge);
    }

    private function checkAge($age) {
        if ($age >= 18) {
            $this->age = $age;
        } else {
            echo "<div class='error'>Вам работать в нашей компании еще рано</div>";
        }
    }
}
//Создайте класс Название_свое(работник), в котором будут следующие свойства:
// name (имя), 
// (возраст),
// salary (зарплата).
// Создайте 2 объекта класса Название_свое(работник), затем установите  свойства своими значениями в каждом объекте, которые вы только что создали.

echo "<h2>Задание 1</h2>";
$worker1 = new Worker("Анна", 25, 50000);
$worker2 = new Worker("Иван", 30, 60000);

echo "<div class='result'>Работник 1: " . $worker1->getName() . ", возраст: " . $worker1->getAge() . ", зарплата: " . $worker1->getSalary() . "</div>";
echo "<div class='result'>Работник 2: " . $worker2->getName() . ", возраст: " . $worker2->getAge() . ", зарплата: " . $worker2->getSalary() . "</div>";

//Выведите на экран: сумму зарплат и сумму возрастов ваших работников.
echo "<h2>Задание 2</h2>";
$totalSalary = $worker1->getSalary() + $worker2->getSalary();
$totalAge = $worker1->getAge() + $worker2->getAge();
echo "<div class='result'>Сумма зарплат: $totalSalary руб.</div>";
echo "<div class='result'>Сумма возрастов: $totalAge лет</div>";

//Сделайте в классе Название_свое(работник)  метод getSalary, который будет возвращать зарплату работника.Выведете на экран работу метода.
echo "<h2>Задание 5</h2>";
echo "<div class='result'>Зарплата работника 1: " . $worker1->getSalary() . " руб.</div>";
echo "<div class='result'>Зарплата работника 2: " . $worker2->getSalary() . " руб.</div>";

// Измените getSalary, чтобы  с помощью метода getSalary находить сумму зарплат созданных работников.Выведете на экран работу метода.
echo "<h2>Задание 6</h2>";
//Временный метод для демонстрации
function getTotalSalary($w1, $w2) {
    return $w1->getSalary() + $w2->getSalary();
}
echo "<div class='result'>Сумма зарплат через функцию: " . getTotalSalary($worker1, $worker2) . " руб.</div>";

//Измените getAge в классе Название_свое(работник) на метод setAge, который параметром будет принимать новый возраст пользователя, а свойство age сделайте скрытым.
//Внесите изменения в метод setAge так, чтобы он вначале проверял, что переданный возраст больше или равен 18. Если это так - пусть метод меняет возраст пользователя, а если не так - выводил что “Вам работать в нашей компании еще рано”.
echo "<h2>Задание 7-8</h2>";
echo "<div class='result'>Текущий возраст работника 1: " . $worker1->getAge() . "</div>";
echo "<div class='result'>Попытка установить возраст 16:</div>";
$worker1->setAge(16); // Должно вывести ошибку
echo "<div class='result'>Попытка установить возраст 28:</div>";
$worker1->setAge(28); // Должно успешно измениться
echo "<div class='success'>Новый возраст работника 1: " . $worker1->getAge() . "</div>";

//Сделайте в классе Название_свое(работник) метод checkAge, который будет проверять то, что работнику больше 18 лет и возвращать true, если это так, и false, если это не так. Выведете на экран работу метода.
//echo "<h2>9. Проверка возраста через публичный метод</h2>";
//class WorkerTemp extends Worker {
//    public function publicCheckAge($age) {
//        return $this->checkAge($age);
//    }
//}
//$tempWorker = new WorkerTemp("Тест", 20, 30000);
//echo "<div class='result'>Проверка возраста 17: " . ($tempWorker->publicCheckAge(17) ? 'true' : 'false') . "</div>";
//echo "<div class='result'>Проверка возраста 25: " . ($tempWorker->publicCheckAge(25) ? 'true' : 'false') . "</div>";

//echo "<h2>Итоговое состояние работников</h2>";
//echo "<div class='result'>Работник 1: " . $worker1->getName() . ", возраст: " . $worker1->getAge() . ", зарплата: " . $worker1->getSalary() . "</div>";
//echo "<div class='result'>Работник 2: " . $worker2->getName() . ", возраст: " . $worker2->getAge() . ", зарплата: " . $worker2->getSalary() . "</div>";

echo "<h2>Задание 9-10</h2>";
echo "<div class='result'>Метод checkAge() недоступен извне класса Worker.<br>
      Он используется только внутри метода setAge().<br>
      Пример работы показан при установке возраста 16 лет (сообщение об ошибке).</div>";
?>
</body>
</html>