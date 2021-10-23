<?php

$conn = null;
function connect() {
  global $conn;

  $conn = mysqli_connect(DBHOST, DBUSER, DBPASS);

  if(!$conn) {
    die(mysqli_error($conn));
  }

  mysqli_select_db($conn, DBNAME);
}
$emial = null;
function getEmployee($email) {
  global $conn;

  $sql = 'SELECT * FROM medarbejdere WHERE email ="'. $email . '"';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nav[] = $row;
    }
  }
  return $nav;
}

function getEmployeeInfo() {
  global $conn;

  $sql = 'SELECT medarbejder_id, fornavn, efternavn, email, tlf  FROM medarbejdere WHERE medarbejder_id > 0';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nav[] = $row;
    }
  }
  return $nav;
}


function getPosts() {
  global $conn;

  $sql = 'SELECT * FROM opslag_med_medarbejder WHERE opslag_id > 0';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nav[] = $row;
    }
  }
  return $nav;
}

function getOrderId() {
  global $conn;

  $sql = 'SELECT MAX(bestillingsliste_id) FROM bestillinger GROUP BY bestillingsliste_id desc ';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nav[] = $row;
      $orderId = (int) $nav[0]['MAX(bestillingsliste_id)'];
    }
  }
  return $orderId;
}

function getRecentOrder($i) {
  global $conn;

  $sql = 'SELECT * FROM bestillinger WHERE bestillingsliste_id = ' . "$i" . ' ';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nav[] = $row;
    }
  }
  return $nav;
}

function getOrderStatus($i){
  global $conn;

  $sql = 'SELECT lagerstatus FROM bestillinger WHERE bestillings_id =' . "$i" . '';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nav[] = $row;
      $orderStatus = (int) $nav[0]['lagerstatus'];
    }
  }
  return $orderStatus;
}
function debug($data) {
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}
