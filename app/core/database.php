<?php
class Database
{
    private static $host = "127.0.0.1";
    private static $dbname = "ssp1";
    private static $username = "root";
    private static $password = "";
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$dbname);
            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }

    public function insertUser($data = [])
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("INSERT INTO users (username, password, fullname, email, address, date_of_birth, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("sssssss", $data['username'], $data['password'], $data['fullname'], $data['email'], $data['address'], $data['dob'], $data['role']);
        return $statement->execute();
    }
}
