<?php
require_once 'member_repository.php';

class member_service {
    private $conn;

    public function __construct() {
        $this->conn = DB::getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM Members ORDER BY ParentId ASC, Name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buildTree(array $elements, $ParentId = null): array {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['ParentId'] == $ParentId) {
                $children = $this->buildTree($elements, $element['Id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function renderTreeHtml(array $tree): string {
        $html = '<ul>';
        foreach ($tree as $node) {
            $html .= "<li>{$node['Name']}";
            if (!empty($node['children'])) {
                $html .= $this->renderTreeHtml($node['children']);
            }
            $html .= "</li>";
        }
        $html .= '</ul>';
        return $html;
    }

    public function renderTree(): string {
        $members = $this->getAll();
        $tree = $this->buildTree($members);
        return $this->renderTreeHtml($tree);
    }

    public function addMember($Name, $ParentId = null): int {
        $stmt = $this->conn->prepare("INSERT INTO Members (Name, ParentId, CreatedDate) VALUES (:Name, :ParentId, NOW())");
        $stmt->execute([
            ':Name' => $Name,
            ':ParentId' => $ParentId
        ]);
        return $this->conn->lastInsertId();
    }
}
