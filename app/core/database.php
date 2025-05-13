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
        $statement->bind_param(
            "sssssss",
            $data['username'],
            $data['password'],
            $data['fullname'],
            $data['email'],
            $data['address'],
            $data['dob'],
            $data['role']
        );
        return $statement->execute();
    }

    public function getUserByUsername($username)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT password, role, date_of_birth FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($data = [])
    {
        $conn = self::getConnection();

        $sql = "UPDATE users SET ";
        $updates = [];
        $params = [];
        $types = "";

        if (!empty($data['fullname'])) {
            $updates[] = "fullname = ?";
            $params[] = $data['fullname'];
            $types .= "s";
        }

        if (!empty($data['email'])) {
            $updates[] = "email = ?";
            $params[] = $data['email'];
            $types .= "s";
        }

        if (!empty($data['address'])) {
            $updates[] = "address = ?";
            $params[] = $data['address'];
            $types .= "s";
        }

        if (empty($updates)) {
            return false; // nothing to update
        }

        $sql .= implode(", ", $updates) . " WHERE username = ?";
        $params[] = $data['username'];
        $types .= "s";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    public function updatePassword($username, $newPassword)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $newPassword, $username);
        return $stmt->execute();
    }

    public function insertProduct($data = [])
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("INSERT INTO products (name, type, genre, duration, platform, price, released_date, age_rating, size, description, img_path, company) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param(
            "sssisdssdsss",
            $data['name'],
            $data['edition'],
            $data['genre'],
            $data['duration'],
            $data['platform'],
            $data['price'],
            $data['released_date'],
            $data['age_rating'],
            $data['size'],
            $data['description'],
            $data['img_path'],
            $data['company']
        );
        return $statement->execute();
    }

    public function getProductById($id)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT name FROM products WHERE pid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
