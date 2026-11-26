let inactivityTimer;

function resetInactivityTimer() {
    clearTimeout(inactivityTimer);

    inactivityTimer = setTimeout(() => {
        window.location.href = "../backend/logout.php?reason=inactive";
    }, 300000); // 5 minutes
}

document.addEventListener("mousemove", resetInactivityTimer);
document.addEventListener("mousedown", resetInactivityTimer);
document.addEventListener("keypress", resetInactivityTimer);
document.addEventListener("scroll", resetInactivityTimer);
document.addEventListener("touchstart", resetInactivityTimer);

resetInactivityTimer();