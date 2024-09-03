<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Access the mobile number and OTP from the session and POST data
    $mobileNumber = isset($_SESSION['mobile_number']) ? $_SESSION['mobile_number'] : null;
    $enteredOtp = isset($_POST['otp']) ? $_POST['otp'] : null;

    if ($mobileNumber === null || $enteredOtp === null) {
        die('Error: Missing mobile number or OTP.');
    }

    // API URL for verifying OTP
    $url = 'http://185.193.19.48:9080/api/v1/verify-otp';

    // Data to be sent in the POST request
    $data = array(
        'country_code' => '+91',
        'mobile_number' => "$mobileNumber",
        'otp' => $enteredOtp
    );

    // Initialize cURL session
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        die('cURL Error: ' . curl_error($ch));
    }

    // Decode the API response
    $responseData = json_decode($response, true);

    // Check if the response is valid JSON
    if ($responseData === null) {
        // Handle the case where the response is not valid JSON
        if (strpos($response, '<html>') !== false) {
            die('Error: Received HTML content, likely a redirect or server error.');
        } else {
            die('Error: Unexpected response format: ' . substr($response, 0, 200));
        }
    }

    // Log the API response for debugging
    var_dump($responseData);
    echo "OTP: " .$enteredOtp;

    // Check if OTP was verified successfully
    if (isset($responseData['success']) == true) {
        // Redirect to the dashboard or profile update based on the response
        if (isset($responseData['profile_updated']) && $responseData['profile_updated']) {
            header('Location:dashboard.html');
        } else {
            header('Location:profile_update.html');
        }
        exit();
    } else {
        // Handle any error messages returned by the API
        $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Unknown error occurred.';
        die('Error: ' . $errorMessage);
    }
}
?>
