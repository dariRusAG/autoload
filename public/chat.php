<html>
<head>
    <meta charset="UTF-8">
    <title>Чатик</title>
</head>
<style>
    body { font-family: 'Times New Roman', sans-serif; }
    button:hover { background: deepskyblue; }
    html {
        background: #e3c963;
        box-shadow: 0 -200px 100px -120px #d94d69 inset;
        animation: background 6s infinite alternate;
    }
    @keyframes background {
        50% { background: skyblue;
            box-shadow: 0 -200px 100px -100px #b3d56e inset;
        }}
</style>
<div>
    <form method="get" action="/">
        <label>Введите свой логин и пароль, чтобы пообщаться с друзьми.</label></p>
        <input size="28" name="login" placeholder="login"/>
        <input size="28" name="password" placeholder="password"/>
        <button type="submit" size="28">АУТЕНТИФИКАЦИЯ</button>
        <button type="submit" name="delete" size="28">ОЧИСТИТЬ ЧАТ</button></p>
    </form>
</div>
</html>

<?php

// Автозагрузка классов из пространства имен в структуру каталогов
spl_autoload_register(function ($className) {
    $ds = DIRECTORY_SEPARATOR;
    $dir = dirname(__DIR__ );

    // Замена разделителя пространства имен на разделитель каталогов
    $className = str_replace('\\', $ds, $className);

    $file = $dir.$ds.'src/'.$className.'.php';

    // Если файл доступен для чтения - получаем его
    if (is_readable($file)) require_once $file;
});

use classes\add_mes;
use classes\subclass\print_mes;

$obj1 = new add_mes();
$obj2 = new print_mes();

$JSON = "/var/www/html/Chat/message_archive.json";

echo "История сообщений:</p>";
$obj2->print_message($JSON);

$user = $_GET['login'];
$password = $_GET['password'];

if ((!empty($user)) || (!empty($password))) {
    if (($user == "admin" && $password == "qwerty") || ($user == "dasha")) {
        setcookie('global_login', $user, time() + 180);
        ?>

        <form method="get" action="/">
            <input size="28" name="message" placeholder="<?php echo $user;?> prints..."/>
            <button type="submit" size="28">ОТПРАВИТЬ СООБЩЕНИЕ</button></p>
        </form>

        <?php
    } else {
        echo "<script> alert('Введены неверные данные.') </script>";
    }}

$message = $_GET['message'];
if(isset($_GET['message']) && $_GET['message'] != ''){
    $obj1->add_message($JSON, $_COOKIE['global_login'], $message);
    header('Refresh: 0; url=chat.php');
}

//Удаление всех сообщений
if (isset($_GET['delete'])){
    unlink($JSON);
    echo "<script> alert('Все данные удалены!') </script>";
    header('Refresh: 0; url=chat.php');
}?>
