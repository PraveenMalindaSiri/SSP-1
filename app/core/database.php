<?php
class Database
{
    private static $host = "127.0.0.1";
    private static $dbname = "ssp1";
    private static $username = "root";
    private static $password = "";
    private static $connection;

    public static function getConnection(){
        if(!self::$connection){
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$dbname);
            if(self::$connection->connect_error){
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }


}
