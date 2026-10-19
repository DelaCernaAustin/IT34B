<?php

require_once('config/config.php');

$user_id = "root" ?? null;
$user_email = "root" ?? null;

$buttons = [
    'Login',
    'Logout',
    'Create Record',
    'Update Record',
    'Delete Record',
    'View Record',
    'Upload File',
    'Download',
    'Generate Report'
];
?>

<table border="1" cellpadding="10">
    <tr>
        <th>Action</th>
        <th>Test</th>
    </tr>

    <?php foreach ($buttons as $button): ?>
        <tr>
            <td><?= htmlspecialchars($button) ?></td>

            <td>
                <form method="POST">
                    <input 
                        type="hidden"  name="action"
                         value="<?= htmlspecialchars($button) ?>"
                    >

                    <button type="submit">Test</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php
If($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = $_POST ['action'] ?? "test_activity";

       $status = 'success';

        $success =  LogActivity(
            $pdo,
            $user_id,
            $user_email,
            $action,
            $status,



        );

        if ($success){

        echo "<p>Activity: " . htmlspecialchars($action) .
                " Status: " . htmlspecialchars($status) .
                "Log inserted sucessfully </p>";

        }else{
            echo "<p>failed to insert activity log</p>";

        }

}


?>