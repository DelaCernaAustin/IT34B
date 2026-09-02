<?php 

require_once('config/config.php');
require_once('activity-logger.php');

$user_id = "root";
$user_email = "root";


$buttons =[
    'login',
    'logout',
    'Create Records',
    'Update Records',
    'Delete Records',
    'View Records',
    'Upload File',
    'Download',
    'Generate Reports'
];

?>

<table border="1" cellpadding="10">

    <tr>
        <th>Action</th>
        <th>Test</th>
    </tr>

    <?php foreach ($buttons as $button): ?>

        <tr>

            <td>
                <?= htmlspecialchars($button) ?>
            </td>

            <td>

                <form method="POST">

                    <input 
                        type="hidden" 
                        name="action"
                        value="<?= htmlspecialchars($button) ?>"
                    >

                    <button type="submit">Test</button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? "test_activity";

    $status = random_int(0, 1) === 1
        ? 'success'
        : 'failed';

    $sucess = logActivity(
        $pdo,
        $user_id,
        $user_email,
        $action,
        $status
    );

    if ($sucess) {

        echo "<p>Activity; " .
             htmlspecialchars($action) .
             " status; " .
             htmlspecialchars($status) .
             " logged successfully.</p>";

    } else {

        echo "<p>Failed to insert activity log</p>";

    }
}

?>
