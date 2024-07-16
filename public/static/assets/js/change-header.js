const header = document.querySelector(".header"); // Thay thế '.header' bằng bộ chọn CSS phù hợp

window.addEventListener("scroll", function () {
    const scrollTop = window.pageYOffset; // Lấy vị trí cuộn dọc hiện tại

    const threshold = 80; // Thay đổi giá trị này để điều chỉnh ngưỡng cuộn

    if (scrollTop > threshold) {
        header.style.backgroundColor = "#23201d"; // Thay đổi màu nền thành màu đỏ
    } else {
        header.style.backgroundColor = "transparent"; // Thay đổi màu nền thành trắng
    }
});
