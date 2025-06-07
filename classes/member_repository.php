<?php
require_once __DIR__ . '/../config/db.php';

class member_repository {
    private $pdo;

    public function __construct() {
        $this->pdo = DB::getConnection();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM members ORDER BY ParentId ASC");
        $members = [];

        while ($row = $stmt->fetch()) {
            $members[$row['ParentId']][] = $row;
        }

        return $members;
    }

    public function insert($name, $ParentId) {
        $stmt = $this->pdo->prepare("INSERT INTO Members (Name, ParentId) VALUES (:name, :parent)");
        $stmt->execute([
            ':name' => $name,
            ':parent' => $ParentId
        ]);
    }
}
