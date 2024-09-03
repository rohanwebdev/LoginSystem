<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Oops! Something went wrong.</h2>
        <p>
        <?php
            echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An unexpected error occurred. Please try again later.'; 
            ?>
        </p>
            
        <a href="send_otp.html" class="btn">Go Back</a>
    </div>
</body>
</html>

