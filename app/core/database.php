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

    // regitering
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // update selected user details
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

    // update password
    public function updatePassword($username, $newPassword)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $newPassword, $username);
        return $stmt->execute();
    }

    public function getAllUsers()
    {
        $conn = self::getConnection();

        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeUser($username)
    {
        $conn = self::getConnection();

        $statment = $conn->prepare("DELETE FROM users WHERE username = ? LIMIT 1");
        $statment->bind_param('s', $username);
        return $statment->execute() && $statment->affected_rows > 0;
    }

    // creating a product
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

    // updating selected product details
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

    public function deleteProduct($pid)
    {
        $conn = self::getConnection();

        $stmt = $conn->prepare("DELETE FROM products WHERE pid = ? LIMIT 1");
        $stmt->bind_param("i", $pid);
        return $stmt->execute() && $stmt->affected_rows > 0;
    }

    // adding wishlist items
    public function AddWishlistItem($pid, $UserAmount, $user)
    {
        $conn = self::getConnection();

        $stmt = $conn->prepare("SELECT amount FROM wishlist WHERE pid = ? AND username = ?");
        $stmt->bind_param("is", $pid, $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($amount);
            $stmt->fetch();

            $newAmount = $amount + $UserAmount;

            $statement = $conn->prepare("UPDATE wishlist SET amount = ? WHERE pid = ? AND username = ?");
            $statement->bind_param('iis', $newAmount, $pid, $user);
            return $statement->execute();
        } else {
            $statement = $conn->prepare("INSERT INTO wishlist (pid, username, amount) VALUES (?, ?, ?)");
            $statement->bind_param('isi', $pid, $user, $UserAmount);
            return $statement->execute();
        }
    }

    public function getWishlistItems($username)
    {
        $conn = self::getConnection();

        $stmt = $conn->prepare(
            "
            SELECT p.*, w.amount
            FROM wishlist w
            JOIN products p ON w.pid = p.pid
            WHERE w.username = ? ORDER BY p.pid ASC"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $wishlistItems = [];

        // iterate until the last row and add detaild to the list 
        while ($row = $result->fetch_assoc()) {
            $wishlistItems[] = $row;
        }

        return $wishlistItems;
    }

    public function deleteWishlistItems($username, $pid)
    {
        $conn = self::getConnection();

        $statement = $conn->prepare("DELETE FROM wishlist WHERE pid = ? AND username = ? LIMIT 1");
        $statement->bind_param("is", $pid, $username);
        return $statement->execute() && $statement->affected_rows > 0;
    }

    // add order
    public function addOrder($user, $totalprice)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("INSERT INTO orders (username, totalprice) VALUES (?,?)");
        $stmt->bind_param('si', $user, $totalprice);
        if ($stmt->execute()) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }

    // adding order details of a order
    public function addOrderProduct($data = [])
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("INSERT INTO orderproducts (orderid, pid, amount, price, digitalcode, is_digital) values (?,?,?,?,?,?)");
        $stmt->bind_param(
            "iiiisi",
            $data['orderID'],
            $data['pid'],
            $data['amount'],
            $data['price'],
            $data['code'],
            $data['is_Digital']
        );
        return $stmt->execute();
    }

    // get order details of a given order ID
    public function getOrderPS($orderID)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM orderproducts WHERE orderid = ?");
        $stmt->bind_param('i', $orderID);
        $stmt->execute();
        $result = $stmt->get_result();
        $orderPS = [];
        while ($row = $result->fetch_assoc()) {
            $orderPS[] = $row;
        }

        return $orderPS;
    }

    public function getOrderByID($id, $username)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM orders WHERE orderid = ? AND username = ?");
        $stmt->bind_param('is', $id, $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getCustomerOrders($customer)
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT * FROM orders WHERE username = ?");
        $statement->bind_param("s", $customer);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllOrders()
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT * FROM orders");
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // adding featuring products
    public function addFeaturingProduct($pid)
    {
        $conn = self::getConnection();
        $statement = $conn->prepare("INSERT INTO featured_products (pid) VALUES (?)");
        $statement->bind_param('i', $pid);
        return $statement->execute();
    }

    // removing featuring products
    public function removeFeaturingProduct($pid)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("DELETE FROM featured_products WHERE pid = ? LIMIT 1");
        $stmt->bind_param('i', $pid);
        return $stmt->execute() && $stmt->affected_rows > 0;
    }

    public function allFeaturingProducts()
    {
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT pid FROM featured_products");
        $stmt->execute();
        $result = $stmt->get_result();
        $pids = [];
        while ($row = $result->fetch_assoc()) {
            $pids[] = $row['pid']; // only the value
        }

        return $pids;
    }

    // total sales of a product
    public function getTotalProductOrders($pid)
    {
        $conn = Database::getConnection();

        // taking the each pids total order amount as total 
        $stmt = $conn->prepare("SELECT SUM(amount) AS total FROM orderproducts WHERE pid = ?");
        $stmt->bind_param('i', $pid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['total'] : 0;
    }
}
