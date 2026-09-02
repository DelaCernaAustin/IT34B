<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/activity-logger.php';

echo "1. Config loaded<br>";
echo "2. Logger loaded<br>";

if (!isset($pdo)) {
    die("PDO DOES NOT EXIST");
}

echo "3. PDO exists<br>";

if (!function_exists('logActivity')) {
    die("logActivity FUNCTION DOES NOT EXIST");
}

echo "4. logActivity exists<br>";

$user_id = 1;
$email = 'root@example.com';
$action = 'test_activity';
$status = 'success';

echo "5. Calling logger...<br>";

$result = logActivity(
    $pdo,
    $user_id,
    $email,
    $action,
    $status
);

if ($result === true) {
    echo "6. SUCCESS! Activity inserted.";
} else {
    echo "6. FAILED!";
}
