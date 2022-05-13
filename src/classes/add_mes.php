<?php
namespace classes;
use DateTimeImmutable;
class add_mes
{
    // Запись сообщений в файл
    static function add_message($JSON, $user, $message){
        $content = json_decode(file_get_contents($JSON));
        $message_object = (object) [
            'date' => (new DateTimeImmutable())->format('Y-m-d h:i'),
            'user' => $user,
            'message' => $message];
        $content->messages[] = $message_object;
        file_put_contents($JSON, json_encode($content));
    echo "Загрузка...";
    }}
?>
