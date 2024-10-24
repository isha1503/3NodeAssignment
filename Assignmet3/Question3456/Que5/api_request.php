<?php
$url = 'http://localhost:3000/api/data';

$responseMessage = '';
$responseData = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];
    $value = $_POST['value'];
    $data = array($key => $value);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);
    $responseMessage = 'Response from Express API (POST): ';
} else {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    $responseMessage = 'Response from Express API (GET): ';
    $responseData = $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Request</title>
</head>
<body>
    <h1>API Request Example</h1>
    
    <!-- Display response -->
    <h2><?php echo $responseMessage; ?></h2>
    <pre><?php print_r($responseData); ?></pre>

    <!-- Form for POST request -->
    <form method="POST" action="">
        <input type="text" name="key" placeholder="Enter a key" required>
        <input type="text" name="value" placeholder="Enter a value" required>
        <input type="submit" value="Send POST Request">
    </form>
</body>
</html>