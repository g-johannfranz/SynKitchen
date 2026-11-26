let logoutTimer;

function resetTimer() {

    clearTimeout(logoutTimer);

    logoutTimer = setTimeout(() => {

        window.location.href =
            "../backend/logout.php?reason=inactive";

    }, 600000); // 10 minutes
}

[
    'mousemove',
    'mousedown',
    'keypress',
    'scroll',
    'touchstart'
].forEach(event => {
    document.addEventListener(event, resetTimer);
});

resetTimer();