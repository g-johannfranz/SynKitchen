<?php

$currentPage = basename($_SERVER['PHP_SELF']);

$firstName = $_SESSION['first_name'] ?? 'User';

?>

<header class="main-header">
    <div class="logo-container">
        <a href="https://www.facebook.com/theburgerhotdog" target="_blank">
            <img src="../frontend/images/logo.png" alt="Logo" class="logo">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="nav-menu">
        <a href="dashboard.php"
           class="<?= ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
            Dashboard
        </a>

        <a href="inventory.php"
           class="<?= ($currentPage == 'inventory.php') ? 'active' : ''; ?>">
            Inventory
        </a>

        <a href="transactions.php"
           class="<?= ($currentPage == 'transactions.php') ? 'active' : ''; ?>">
            Transactions
        </a>
    </nav>

    <div class="logout-container">

        <button class="logout-btn" onclick="openLogoutModal()">
            Log Out
        </button>
    </div>
</header>

<div id="logoutModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Logout</h3>
        <p>Are you sure you want to log out?</p>

        <div class="modal-buttons">
            <button class="btn-cancel" onclick="closeLogoutModal()">
                Cancel
            </button>

            <button class="btn-confirm-logout" onclick="logout()">
                Log Out
            </button>
        </div>
    </div>
</div>
