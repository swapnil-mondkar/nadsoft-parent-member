<?php
require_once __DIR__ . '/../config/db.php';

class MemberRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = DB::getConnection();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Members ORDER BY ParentId ASC, Name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($name, $ParentId = null): int {
        $stmt = $this->pdo->prepare("INSERT INTO Members (Name, ParentId, CreatedDate) VALUES (:name, :parent, NOW())");
        $stmt->execute([
            ':name' => $name,
            ':parent' => $ParentId
        ]);
        return $this->pdo->lastInsertId();
    }
}
