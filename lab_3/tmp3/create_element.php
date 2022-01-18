<?php

header("Content-Type: application/json");

// import connect to db file
require "connect.php";

// check if POST array is complete
if (!isset($_POST["title"]) || !$_POST["title"]) {
  echoError("Invalid title field in POST array");
  die;
}

if (!isset($_POST["name"]) || !$_POST["name"] || count($_POST["name"]) < 1) {
  echoError('Invalid name field in POST array');
  die;
}

if (!isset($_POST["content"]) || !$_POST["content"] || count($_POST["content"]) < 1) {
  echoError("Invalid content field in POST array");
  die;
}

// destructing POST array
$_title = $_POST["title"];
$_secondColor = $_POST["second_color"];
$_accentColor = $_POST["accent_color"];
$_tabNames = $_POST["name"];
$_tabContents = $_POST["content"];

// if its an update and not an insertion
if (isset($_POST['id'])) {
  // updating the elements table
  $stmt = $pdo->prepare("UPDATE `elements` SET title=?, accent_color=?, second_color=? WHERE id=?");
  $stmt->execute([$_title, $_accentColor, $_secondColor, $_POST["id"]]);

  // updating the tabs table
  $pdo->prepare("DELETE FROM `tabs` WHERE element_id=?")->execute([$_POST["id"]]);

  // prepare tab data to insert in db
  $data = [];

  foreach ($_tabNames as $i => $name) {
    $data[] = [
      $name, $_tabContents[$i], $_POST['id']
    ];
  }

  // inserting tab data into db
  $statement = $pdo->prepare("INSERT INTO `tabs` (`name`, `content`, `element_id`) VALUES (?,?,?)");

  try {
    $pdo->beginTransaction();

    foreach ($data as $row) {
      $statement->execute($row);
    }

    $pdo->commit();
  } catch (Exception $e) {
    $pdo->rollback();
    echoError($e->getMessage(), $e->getCode());
    die;
  }

  // send ok response
  http_response_code(200);
  echo json_encode([
    "success" => 1
  ]);


  die;
}

// insert element into db
$pdo->prepare("INSERT INTO `elements` (`title`, `accent_color`, `second_color`) VALUES (?, ?, ?)")->execute([$_title, $_accentColor, $_secondColor]);

// id of the saved element
$id = $pdo->lastInsertId();

// prepare tab data to insert in db
$data = [];

foreach ($_tabNames as $i => $name) {
  $data[] = [
    $name, $_tabContents[$i], $id
  ];
}

// inserting tab data into db
$statement = $pdo->prepare("INSERT INTO `tabs` (`name`, `content`, `element_id`) VALUES (?,?,?)");

try {
  $pdo->beginTransaction();

  foreach ($data as $row) {
    $statement->execute($row);
  }

  $pdo->commit();
} catch (Exception $e) {
  $pdo->rollback();
  echoError($e->getMessage(), $e->getCode());
  die;
}

// send ok response
http_response_code(200);
echo json_encode([
  "success" => 1
]);
