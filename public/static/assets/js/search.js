// Lấy ra các phần tử DOM
const searchToggle = document.querySelector(".top-act__search");
const searchBar = document.querySelector(".search-container");
const searchInput = document.getElementById("searchInput");

// Định nghĩa hàm hiển thị searchBar và ẩn searchToggle
function showSearchBar() {
    searchBar.style.display = "block"; // Hiển thị searchBar
    searchToggle.style.display = "none"; // Ẩn searchToggle
    searchInput.focus(); // Tự động focus vào input
}

// Gắn sự kiện click vào button searchToggle
searchToggle.addEventListener("click", showSearchBar);

// Định nghĩa hàm ẩn searchBar và hiển thị searchToggle
function hideSearchBar() {
    searchBar.style.display = "none"; // Ẩn searchBar
    searchToggle.style.display = "block"; // Hiển thị searchToggle
}

// Định nghĩa hàm clickOutside để xử lý việc click ra ngoài searchBar và searchToggle
function clickOutside(event) {
    // Kiểm tra click có thuộc searchBar hoặc searchToggle không
    if (
        !searchBar.contains(event.target) &&
        !searchToggle.contains(event.target) &&
        searchBar.style.display === "block"
    ) {
        hideSearchBar();
    }
}

// Gắn sự kiện click vào document để xử lý click ra ngoài
document.addEventListener("click", clickOutside);
