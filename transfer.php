<?php
$mysqli = new mysqli("localhost", "root", "", "customerdb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$fromAccount = $_POST['fromAccount'];
$toAccount = $_POST['toAccount'];
$amount = $_POST['amount'];

$query = "SELECT balance FROM customerinfo WHERE account_no = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $fromAccount);
$stmt->execute();
$stmt->bind_result($senderBalance);
$stmt->fetch();
$stmt->close();

if ($senderBalance < $amount) {
    echo "Insufficient balance.";
} else {
    $query = "UPDATE customerinfo SET balance = balance - ? WHERE account_no = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ds", $amount, $fromAccount);
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE customerinfo SET balance = balance + ? WHERE account_no = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ds", $amount, $toAccount);
    $stmt->execute();
    $stmt->close();

    echo "Transaction successful.";
}

$query = "INSERT INTO transactions (sender_account_no, receiver_account_no, amount) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssd", $fromAccount, $toAccount, $amount);
$stmt->execute();
$stmt->close();


$mysqli->close();
?>
