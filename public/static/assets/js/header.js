document.addEventListener("DOMContentLoaded", (event) => {
    const dropdown = document.querySelector(".dropdown");

    if (dropdown) {
        const dropdownMenu = dropdown.querySelector(".dropdown-menu");

        dropdown.addEventListener("mouseenter", () => {
            dropdownMenu.classList.add("show");
        });

        dropdown.addEventListener("mouseleave", () => {
            dropdownMenu.classList.remove("show");
        });
    }

    const likeButton = document.getElementById("likeButton");
    if (likeButton) {
        const likeImage = document.querySelector(".likeImage");

        likeButton.addEventListener("click", function () {
            if (likeImage) {
                likeImage.classList.toggle("liked");
                if (likeImage.classList.contains("liked")) {
                    likeImage.src = "static/assets/button/liked.svg";
                } else {
                    likeImage.src = "static/assets/button/like.svg";
                }
            }
        });
    }
});
