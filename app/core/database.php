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
            "sssisdsidsss",
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

    public function getProductsBySeller($seller)
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT pid, name, type, price FROM products WHERE company = ?");
        $statement->bind_param('s', $seller);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function getProducts()
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT * FROM products");
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE pid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateProduct($data = [])
    {
        $conn = self::getConnection();

        $sql = "UPDATE products SET ";
        $updates = [];
        $params = [];
        $types = "";

        if (!empty($data['name'])) {
            $updates[] = "name = ?";
            $params[] = $data['name'];
            $types .= "s";
        }

        if (!empty($data['genre'])) {
            $updates[] = "genre = ?";
            $params[] = $data['genre'];
            $types .= "s";
        }

        if (!empty($data['duration'])) {
            $updates[] = "duration = ?";
            $params[] = $data['duration'];
            $types .= "i";
        }

        if (!empty($data['platform'])) {
            $updates[] = "platform = ?";
            $params[] = $data['platform'];
            $types .= "s";
        }

        if (!empty($data['price'])) {
            $updates[] = "price = ?";
            $params[] = $data['price'];
            $types .= "d";
        }

        if (!empty($data['released_date'])) {
            $updates[] = "released_date = ?";
            $params[] = $data['released_date'];
            $types .= "s";
        }

        if (!empty($data['age_rating'])) {
            $updates[] = "age_rating = ?";
            $params[] = $data['age_rating'];
            $types .= "i";
        }

        if (!empty($data['size'])) {
            $updates[] = "size = ?";
            $params[] = $data['size'];
            $types .= "d";
        }

        if (!empty($data['description'])) {
            $updates[] = "description = ?";
            $params[] = $data['description'];
            $types .= "s";
        }

        if (empty($updates)) {
            return false; // nothing will update
        }

        $sql .= implode(", ", $updates) . " WHERE pid = ?";
        $params[] = $data['pid'];
        $types .= "i";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    public function deleteProduct($pid){
        $conn = self::getConnection();

        $stmt = $conn->prepare("DELETE FROM products WHERE pid = ? LIMIT 1");
        $stmt->bind_param("i", $pid);
        return $stmt->execute() && $stmt->affected_rows > 0;
    }
}
