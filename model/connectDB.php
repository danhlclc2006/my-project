
<?php
require_once "connectDB.php"; 
class connectDB {
    private $host = "localhost";
    private $dbname = "duanmau2025";    
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
    



    // Lấy tất cả bản ghi
    public function queryAll($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Lấy 1 bản ghi
    public function queryOne($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    // Thực thi thêm, sửa, xóa
    public function execute($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    // Lấy ID sau khi thêm mới
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>
