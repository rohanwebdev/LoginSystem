<?php
session_start();
session_destroy(); // Destroy all session data

// Redirect to the Send OTP screen
header('Location: send_otp.html');
exit();
?>