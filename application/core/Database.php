<?php

class Database
{

    public function connect_to_db () {
        $mysqli = new mysqli("localhost", "root", "root", "test");
        /* проверка соединения */
        if ($mysqli->connect_errno) {
            printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
            exit();
        }
        return $mysqli;
    }

}
