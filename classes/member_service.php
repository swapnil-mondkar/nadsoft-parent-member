<?php
require_once 'member_repository.php';

class MemberService {
    private $repo;

    public function __construct() {
        $this->repo = new MemberRepository();
    }

    public function getAll() {
        return $this->repo->getAll();
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
        return $this->repo->insert($Name, $ParentId);
    }
}
