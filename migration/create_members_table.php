<?php
require_once __DIR__ . '/../config/db.php';

$pdo = DB::getConnection();

$sql = "
CREATE TABLE IF NOT EXISTS Members (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    CreatedDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    Name VARCHAR(50) NOT NULL,
    ParentId INT DEFAULT NULL,
    FOREIGN KEY (ParentId) REFERENCES Members(Id) ON DELETE CASCADE
);
";

$pdo->exec($sql);
echo "Table created successfully.\n";
