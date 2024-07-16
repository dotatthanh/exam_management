var swiper = new Swiper(".swiper-container", {
    slidesPerView: 4,
    spaceBetween: 24, // Không duplicate và chỉ đặt giá trị này một lần
    loop: false,
    slidesPerGroup: 1,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    on: {
        init: function () {
            // Ẩn nút prev khi khởi tạo
            if (this.navigation.prevEl) {
                this.navigation.prevEl.style.display = "none";
            }
        },
        slideNextTransitionStart: function () {
            // Hiển thị nút prev sau khi click nút next
            if (this.navigation.prevEl) {
                this.navigation.prevEl.style.display = "block";
            }
        },
        reachBeginning: function () {
            // Ẩn nút prev khi ở slide đầu tiên
            if (this.navigation.prevEl) {
                this.navigation.prevEl.style.display = "none";
            }
        },
    },
});
