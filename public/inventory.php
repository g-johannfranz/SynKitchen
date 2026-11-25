<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="../frontend/css/styles.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Page Content -->
    </main>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../frontend/js/scripts.js"></script>

</body>
</html>