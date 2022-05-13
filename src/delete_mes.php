<?php

class delete_mes
{
    static function delete($JSON){
        unlink($JSON);
        echo "<script> alert('Все данные удалены!') </script>";
    }}
?>
