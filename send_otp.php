<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve mobile number from POST data
    $mobileNumber = $_POST['mobile_number'];

    // Store mobile number in session for later use
    $_SESSION['mobile_number'] = $mobileNumber;

    // API URL for sending OTP
    $url = 'http://185.193.19.48:9080/api/v1/send-otp';

    // Data to be sent in the POST request
    $data = array(
        'country_code' => '+91',
        'mobile_number' => $mobileNumber
    );

    // Initialize cURL session
    $ch = curl_init($url);

    // Configure cURL options
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

    // Check if the response was successfully decoded
    if ($responseData === null) {
        // Handle the case where the response is not valid JSON
        die('Error: Failed to decode JSON response.');
    }

    // Check if the OTP was sent successfully
    if (isset($responseData['success']) && $responseData['success'] === true) {
        // Redirect to the Enter OTP screen
        header('Location: enter_otp.html');
        exit();
    } else {
        // Handle any error messages returned by the API
        $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Unknown error occurred.';
        die('Error: ' . $errorMessage);
    }

    // Close cURL session
    curl_close($ch);
}
?>
