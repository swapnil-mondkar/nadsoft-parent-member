<?php
require_once 'config/db.php';
require_once 'classes/member_service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Name = trim($_POST['Name'] ?? '');
    $ParentId = $_POST['ParentId'] ?? null;

    if (!preg_match('/^[a-zA-Z\s]+$/', $Name)) {
        echo json_encode(['success' => false, 'message' => 'Invalid name. Use letters and spaces only.']);
        exit;
    }

    $ParentId = $ParentId ?: null;

    $service = new MemberService();
    $Id = $service->addMember($Name, $ParentId);

    $ParentName = null;
    if ($ParentId) {
        $members = $service->getAll();
        foreach ($members as $m) {
            if ($m['Id'] == $ParentId) {
                $ParentName = $m['Name'];
                break;
            }
        }
    }

    echo json_encode([
        'success' => true,
        'Id' => $Id,
        'Name' => $Name,
        'ParentId' => $ParentId,
        'ParentName' => $ParentName,
    ]);
    exit;
}
