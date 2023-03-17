<?php

        $username = "root";
        $password = "";
        try {
            $bd = new PDO("mysql:host=localhost;dbname=révisions;charset=utf8mb4", $username, $password);
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully" . "<br>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        ?>
        