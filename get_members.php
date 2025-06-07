<?php
require_once 'config/db.php';
require_once 'classes/member_service.php';

$service = new memberService();
$members = $service->getAll();

echo json_encode($members);
