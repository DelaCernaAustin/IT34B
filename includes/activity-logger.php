<?php

function logActivity(
    $pdo,
    $user_id,
    $email,
    $action,
    $status = 'success'
) {
    try {

        // Get user's IP address
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

        // Get browser/user-agent
        $user_agent = substr(
            $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN',
            0,
            255
        );

        // Prepare SQL
        $stmt = $pdo->prepare("
            INSERT INTO activity_logs (
                user_id,
                user_email,
                activity_log_action,
                activity_log_status,
                activity_log_address,
                activity_log_user_agent
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        // Execute
        $stmt->execute([
            $user_id,
            $email,
            $action,
            $status,
            $ip,
            $user_agent
        ]);

        return true;

    } catch (PDOException $e) {

        // Don't expose database details in production
        error_log(
            'Activity Logger Error: ' .
            $e->getMessage()
        );

        return false;
    }
}
