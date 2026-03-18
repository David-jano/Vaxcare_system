<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send SMS</title>
</head>
<body>
    <form method="POST">
        <input type="number" name="mno" placeholder="Enter phone number"><br><br>
        <textarea name="message" placeholder="Enter your message"></textarea>
        <input type="submit" name="send" value="Send">
    </form>
</body>
</html>

<?php
if(isset($_POST['send'])){
    $num = '250' . $_POST['mno'];
    $message = $_POST['message'];

    $apiKey = urlencode('NTEzODcwNmM0YTY1NzI2ZDU0NTY2YTRjNmY3NjMzNDk=');
    $numbers = array($num);
    $sender = urlencode('Jims Autos');
    $message = rawurlencode($message);

    $numbers = implode(',', $numbers);

    $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
    $ch = curl_init('https://api.txtlocal.com/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process the API response
    $response_array = json_decode($response, true);

    if (isset($response_array['status']) && $response_array['status'] == 'success') {
        echo 'Message sent successfully. Message ID: ' . $response_array['data']['message'][0]['id'];
    } else {
        echo 'Message sending failed. Error: ' . $response_array['errors'][0]['message'];
    }
}
?>







     
