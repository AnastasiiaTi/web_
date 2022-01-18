<?php

require "config.php";

// function to send errors
function echoError($errorMessage, $errorCode = 0)
{
  http_response_code(500);
  echo json_encode([
    "error" => $errorCode,
    "message" => $errorMessage
  ]);
}

// db connect string
$dsn = "mysql:host=" . DB_HOST .
  ":" . DB_PORT .
  ";dbname=" . DB_NAME .
  ";charset=" . DB_CHARSET;

// db connect options
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => 1,
];

// load db schema from file
$schema = trim(file_get_contents(SCHEMA_FILE));

// db connection
try {
  $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
  echoError($e->getMessage(), $e->getCode());
  die;
}

// create tables as in schema
$pdo->query($schema);
