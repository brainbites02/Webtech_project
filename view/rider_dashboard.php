<?php
session_start();
include "../Model/db.php";


if (!isset($_SESSION['rider_id']))
 {
    header("Location: login.php");
    exit();
}


$rider_orders = getPendingOrdersForRider();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rider Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../ajax/assignOrder.js"></script>
</head>
<body>
    <h2>Welcome, <?= $_SESSION['rider_name']; ?></h2>
    <h3>Orders to Deliver</h3>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rider_orders as $order): ?>
                <tr id="order-<?= $order['o_id']; ?>">
                    <td><?= $order['o_id']; ?></td>
                    <td class="status"><?= $order['delivery_status']; ?></td>
                    <td><?= $order['total_price']; ?></td>
                    <td>
                        <button onclick="assignOrder(<?= $order['o_id']; ?>, <?= $_SESSION['rider_id']; ?>)">
                            Accept Order
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
