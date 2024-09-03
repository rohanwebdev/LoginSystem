<?php
session_start();

// if (!isset($_SESSION['access_token'])) {
//     die('Error: Access token is missing. Please log in again.');
// }

// $accessToken = $_SESSION['access_token'];
// echo $accessToken;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Data to be sent in the POST request
    $data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'company' => $_POST['company'],
        'state' => $_POST['state'],
        'city' => $_POST['city'],
        'sponsor_code' => $_POST['sponsor_code']
    );

    // API URL for updating profile
    $url = 'http://185.193.19.48:9080/api/v1/create-profile';
    $token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjc4LCJleHAiOjE3MjY2NTExMDEsImlhdCI6MTcyNTM3NTYwM30.50L2gdhVumm3ouln0X8lWQdCVhFhwLS9spxg5fdtnsY";
  

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_SESSION['access_token']=$token // Include the access token in the header
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    // Execute the request and get the response
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // is response runs redirect to dashboard page
   if ($response){
    header("location: dashboard.html");
    
    if ($response) {
        // make array of success profile to print in dashboard page
        $success_data = array(
            'success' => true,
            'message' => "Profile updated successfully"
        );
        $_SESSION['success_data']=$success_data;
    }
    
   }

    // Check for curl errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        if ($http_code == 200) {
            echo 'Profile updated successfully.';
            // Redirect to dashboard 
            header('Location: dashboard.html');
            exit();
        } else {
            echo 'Failed to update profile. Please try again.';
        }
    }

    // Close the curl session
    curl_close($ch);
}






























//     // Initialize cURL session
//     $ch = curl_init($url);

//     // Configure cURL options
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         'Content-Type: application/json',
//         'Authorization: Bearer '  . $_SESSION['access_token']=$token
//     ));

//     // Execute cURL request
//     $response = curl_exec($ch);

//     // Check for cURL errors
//     if ($response === false) {
//         die('cURL Error: ' . curl_error($ch));
//     }

//     // Decode the API response
//     $responseData = json_decode($response, true);

//     // Check if the profile was updated successfully
//     if (isset($responseData['status']) && $responseData['status'] === 200) {
//         // Redirect to the Dashboard
//         header('Location:dashboard.html');
//         exit();
//     } else {
//         $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Unknown error occurred.';
//         die('Error: ' . $errorMessage);
//     }
// }
?>
