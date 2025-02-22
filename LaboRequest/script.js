document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.getElementById("user-icon");
    const userCard = document.getElementById("user-card");

    userIcon.addEventListener("click", () => {
        userCard.classList.toggle("hidden");
    });

    document.addEventListener("click", (event) => {
        if (!userIcon.contains(event.target) && !userCard.contains(event.target)) {
            userCard.classList.add("hidden");
        }
    });
});
