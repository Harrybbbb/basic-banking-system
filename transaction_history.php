<?php
// Establish a database connection
$mysqli = new mysqli("localhost", "root", "", "customerdb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
    <link rel="stylesheet" type="text/css" href="history.css">
</head>
<body>
    <div class="heading"> <h1>Transaction <span class="history">History</span></h1></div>
   <div class="table">
    <table>
        <tr>
            <th>Sender Account</th>
            <th>Receiver Account</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        <?php
        $query = "SELECT sender_name, sender_account_no, receiver_name, receiver_account_no, amount, transaction_date FROM transactions";
        $result = $mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['sender_account_no'] . "</td>";
            echo "<td>" . $row['receiver_account_no'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['transaction_date'] . "</td>";
            echo "</tr>";
        }

        $result->close();
        ?>
    </table>
    </div>
</body>
</html>
