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

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".login-form");
    const leftPanel = document.querySelector(".left-panel");
    const rightPanel = document.querySelector(".right-panel");

    form.addEventListener("focusin", () => {
        setTimeout(() => {
            leftPanel.classList.add("hide");
            rightPanel.classList.add("center");
        }, 100);
    });

    form.addEventListener("focusout", () => {
        setTimeout(() => {
            if (!form.contains(document.activeElement)) {
                leftPanel.classList.remove("hide");
                rightPanel.classList.remove("center");
            }
        }, 500);
    });
});

if (window.location.search.includes('loggedout=inactive')) {
        window.history.replaceState({}, document.title, window.location.pathname);
}