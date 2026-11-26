<footer class="main-footer">

    <div class="footer-left">
        <img src="../frontend/images/logo.png" alt="Logo" class="footer-logo">
    </div>

    <div class="footer-center">
        <p>&copy; <?php echo date('Y'); ?> The BurgerHotdog. All Rights Reserved.</p><br>
        <p>SynKitchen V1.0</p>
    </div>

    <div class="footer-right">
        <span class="current-user">

            Current User:
            <br>
            <strong>
                <?= htmlspecialchars($firstName) ?>
            </strong>

        </span>
    </div>

</footer>