document.addEventListener("DOMContentLoaded", function () {
    var slides = document.querySelectorAll(".banner .banner-slide");
    var banners = document.querySelectorAll(".banner .banner_inner");
    var currentSlide = 0;
    var slideInterval = 6000; // Thời gian chuyển đổi slide là 6 giây

    // Hàm ẩn tất cả các slides và banners
    function hideAllSlides() {
        slides.forEach(function (slide) {
            slide.style.display = "none";
        });
        banners.forEach(function (banner) {
            banner.style.display = "none";
        });
    }

    // Hàm hiển thị slide hiện tại cùng với thông tin và link tương ứng
    function showCurrentSlide() {
        hideAllSlides(); // Ẩn tất cả các slide và banners trước khi hiển thị slide tiếp theo
        slides[currentSlide].style.display = "block";
        banners[currentSlide].style.display = "block";
    }

    // Tạo một interval để chạy hàm showCurrentSlide mỗi 6 giây
    setInterval(function () {
        currentSlide = (currentSlide + 1) % slides.length; // Tính toán chỉ số slide tiếp theo
        showCurrentSlide(); // Hiển thị slide tiếp theo
    }, slideInterval);

    showCurrentSlide(); // Hiển thị slide đầu tiên khi tải trang
});
