<?php
namespace classes\subclass;
class print_mes
{
    public static function print_message($file){
        // Если файл существует - получаем его содержимое
        if (file_exists($file)){
            $content = json_decode(file_get_contents($file));
            foreach($content->messages as $message){
                echo "<p>$message->date $message->user: $message->message</p>";
            }} else echo "История сообщений пуста :(</p>";
    }}
?>
