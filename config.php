<?php
require_once __DIR__ . '/vendor/autoload.php';

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

$awsRegion = 'eu-central-1';
$secretName = 'links_app_pass_users';

$sdk = new Aws\Sdk([
    'region' => $awsRegion,
    'version' => 'latest'
]);

$client = $sdk->createSecretsManager();
$secretValue = '';

try {
    $result = $client->getSecretValue([
        'SecretId' => $secretName
    ]);
    $secretValue = $result['SecretString'];
} catch (AwsException $e) {
    error_log($e->getAwsRequestId());
    error_log($e->getAwsErrorType());
    error_log($e->getAwsErrorCode());
    error_log($e->getMessage());
}

$secrets = json_decode($secretValue, true);

$servername = $secrets['db_admin']['host'];
$username = $secrets['db_admin']['username'];
$password = $secrets['db_admin']['password'];
$dbname = "link_app_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$weather_api_key = $secrets['weather_api_key'];

// Set the session timeout to 30 minutes (1800 seconds)
ini_set('session.gc_maxlifetime', 1800);
session_set_cookie_params(1800);

session_start();
