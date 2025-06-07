<?php
require_once __DIR__ . '/../config/db.php';

$pdo = DB::getConnection();

$pdo->exec("DELETE FROM Members");

$data = [
    ['Name' => 'John', 'ParentId' => null],
    ['Name' => 'Alice', 'ParentId' => 1],
    ['Name' => 'Bob', 'ParentId' => 1],
    ['Name' => 'Charlie', 'ParentId' => 2],
    ['Name' => 'Diana', 'ParentId' => 3],
];

$stmt = $pdo->prepare("INSERT INTO Members (Name, ParentId) VALUES (:name, :parent)");

foreach ($data as $member) {
    $stmt->execute([
        ':name' => $member['Name'],
        ':parent' => $member['ParentId']
    ]);
}

echo "Seeded successfully.\n";
