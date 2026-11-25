function openLogoutModal() {
    document.getElementById("logoutModal").style.display = "flex";
}

function closeLogoutModal() {
    document.getElementById("logoutModal").style.display = "none";
}

function logout() {
    window.location.href = "../backend/logout.php";
}

window.addEventListener("click", function (event) {
    const modal = document.getElementById("logoutModal");

    if (event.target === modal) {
        closeLogoutModal();
    }
});

window.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeLogoutModal();
    }
});