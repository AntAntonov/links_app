<!DOCTYPE html>
<html>
<head>
    <title>Main</title>
</head>
<body>
<?php
session_start();
require_once 'config.php';
    
$apiKey = $weather_api_key;
$city = "Bielefeld";
$weatherUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
$weatherData = file_get_contents($weatherUrl);
$weatherJson = json_decode($weatherData, true);

$weatherDescription = $weatherJson["weather"][0]["description"];
$temperature = $weatherJson["main"]["temp"];

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST['url'];
    $category = $_POST['category'];
    $username = $_SESSION["username"];

    $sql = "INSERT INTO links (user_id, url, category) SELECT id, ?, ? FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $url, $category, $username);
    $stmt->execute();
}

$sql = "SELECT url, category FROM links ORDER BY id DESC LIMIT 5";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($url, $category);
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label>URL:</label>
    <input type="url" name="url" required>
    <br>
    <label>Category:</label>
    <select name="category" required>
        <option value="Kid">Kid</option>
        <option value="House">House</option>
        <option value="Clothes">Clothes</option>
        <option value="Car">Car</option>
    </select>
    <br>
    <input type="submit" value="Save">
</form>
<div>
    <h3>Last 5 entered links:</h3>
    <ul>
    <?php while ($stmt->fetch()): ?>
        <li>
            <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a> - <?php echo $category; ?>
        </li>
    <?php endwhile; ?>
    </ul>
</div>
<div>
    <h3>Weather in <?php echo $city; ?>:</h3>
    <p><?php echo $weatherDescription; ?>, temperature: <?php echo $temperature; ?>°C</p>
</div>
</body>
</html>
