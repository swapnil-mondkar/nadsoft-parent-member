<?php
require_once 'config/db.php';
require_once 'classes/member_service.php';

$service = new member_service();
echo $service->renderTree();
