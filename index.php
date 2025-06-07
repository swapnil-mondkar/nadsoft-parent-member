<?php
require_once 'config/db.php';
require_once 'classes/member_service.php';

$service = new MemberService();
$members = $service->getAll();

$tree = $service->renderTree();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Members</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
</head>
<body>

<div id="memberTree">
    <?= $tree ?>
</div>

<a href="#addMemberModal" data-fancybox>
    <button>Add Member</button>
</a>

<div style="display: none;" id="addMemberModal">
    <form id="addMemberForm">
        <label>Name:</label><br>
        <input type="text" name="Name" id="nameField" required><br><br>

        <label>Parent:</label><br>
        <select name="ParentId" id="parentSelect">
            <option value="">-- No Parent --</option>
            <?php foreach ($members as $m): ?>
                <option value="<?= htmlspecialchars($m['Id']) ?>"><?= htmlspecialchars($m['Name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Save Changes</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>
