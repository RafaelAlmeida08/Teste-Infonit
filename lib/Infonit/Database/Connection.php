<?php

    namespace Infonit\Database;

    abstract class Connection{

        private static $conn;

        public static function getConn(){
            if(!self::$conn){
                self::$conn = new \PDO('mysql: host=107.180.50.241;dbname=infonit','infonit','infonit');
            }
            return self::$conn;
        }
    }