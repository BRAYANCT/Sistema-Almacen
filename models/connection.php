<?php
// crar coneccion con la db


class connection
{

    public function connect()
    {
        $ruta = "localhost";
        $name = "SistemaVEntas";
        $user = "root";
        $password = "";
        
        $link = new PDO(
            "mysql:host=$ruta;dbname=$name",
            $user,
            $password
        );

        $link->exec("set names utf8");

        return $link;
    }
}

