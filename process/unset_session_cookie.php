<?php
session_start();
setcookie('site_session', '', time() - 3600, "/"); // Unset the session cookie
echo json_encode(['success' => true]);
?>
