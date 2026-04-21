<?php
class Page
{
    private string $name;
    private string $template;

    public function __construct(string $name = "page", string $template = "<div><p>It is a default page</p></div>")
    {
        $this->name = $name;
        $this->template = $template;
    }

    public function render(): void
    {
        echo $this->template;
    }
}

class BlogPage extends Page
{
    public function __construct()
    {
        $template = '
            <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px;">
                <div class="card">
                    <h3>Пост 1: Основы GET-запросов</h3>
                    <p>GET-параметры передаются через URL после знака ? и разделяются &</p>
                </div>
                <div class="card">
                    <h3>Пост 2: Суперглобальный массив $_GET</h3>
                    <p>В PHP все GET-параметры автоматически попадают в ассоциативный массив $_GET</p>
                </div>
                <div class="card">
                    <h3>Пост 3: Проверка существования параметров</h3>
                    <p>Всегда используйте isset() или empty() перед обращением к $_GET</p>
                </div>
            </div>
        ';
        parent::__construct("blog", $template);
    }
}

class GetInfoPage extends Page
{
    public function __construct()
    {
        $template = '
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; border-radius: 15px; color: white;">
                <h3>Информация о GET-параметрах</h3>
                <p>Текущие GET-параметры в URL:</p>
                <pre style="background: rgba(0,0,0,0.3); color: #0f0; padding: 15px; border-radius: 8px; overflow-x: auto;">' . htmlspecialchars(print_r($_GET, true)) . '</pre>
                <hr style="background: rgba(255,255,255,0.3);">
                <h4>Примеры использования:</h4>
                <ul>
                    <li><code style="color: #000000;">?page=getinfo&user_id=123&action=edit</code></li>
                    <li><code style="color: #000000;">?page=getinfo&search=php&category=tutorial</code></li>
                    <li><code style="color: #000000;">?page=getinfo&id=5&mode=debug</code></li>
                </ul>
                <p><strong>Важно:</strong> Всегда экранируйте вывод GET-параметров через htmlspecialchars() для безопасности!</p>
            </div>
        ';
        parent::__construct("getinfo", $template);
    }
}

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'blog':
            $page = new BlogPage();
            break;
        case 'getinfo':
            $page = new GetInfoPage();
            break;
        case 'page':
        default:
            $page = new Page();
            break;
    }
} else {
    $page = new Page();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №14</title>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fb 0%, #e9eef5 100%);
        }
        h1 {
            color: #1e2a3e;
            border-left: 5px solid #3b82f6;
            padding-left: 20px;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #64748b;
            margin-left: 25px;
            margin-bottom: 30px;
        }
        .buttons {
            display: flex;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .btn {
            background: white;
            border: 2px solid #cbd5e1;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            color: #0f172a;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: inline-block;
        }
        .btn:hover {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(59,130,246,0.3);
        }
        .btn:active {
            transform: translateY(0);
        }
        .card {
            border: 1px solid #e2e8f0;
            background: white;
            padding: 20px;
            width: 240px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.12);
            border-color: #3b82f6;
        }
        .card h3 {
            margin-top: 0;
            color: #1e293b;
        }
        hr {
            margin: 30px 0;
            border: none;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, #764ba2, transparent);
        }
        .content-wrap {
            background: white;
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin-top: 20px;
            min-height: 300px;
        }
        .content-wrap h2 {
            margin-top: 0;
            color: #1e2a3e;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }
        code {
            background: #f1f5f9;
            padding: 2px 6px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }
    </style>
</head>
<body>


<div class="buttons">
    <a href="?page=page" class="btn">1. Главная (Page)</a>
    <a href="?page=blog" class="btn">2. Блог (BlogPage)</a>
    <a href="?page=getinfo" class="btn">3. GET-инфо (по теме)</a>
</div>

<hr>

<div class="content-wrap">
    <h2>▶ Содержимое страницы:</h2>
    <?php
    $page->render();
    ?>
</div>

</body>
</html>