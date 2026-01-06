function filterBrands() {
    var idDanhMuc = document.getElementById("danhmuc").value; 
    var selectThuongHieu = document.getElementById("thuonghieu");
    var options = document.getElementsByClassName("brand-option");
    
    // Lấy giá trị thương hiệu đang được chọn hiện tại (để không bị reset mất khi load trang)
    var currentBrand = selectThuongHieu.value;

    for (var i = 0; i < options.length; i++) {
        var phanLoaiBrand = options[i].getAttribute("data-phanloai"); 
        
        if (idDanhMuc === "" || phanLoaiBrand == "0" || phanLoaiBrand == idDanhMuc) {
            options[i].style.display = "block"; 
            options[i].disabled = false;
        } else {
            options[i].style.display = "none";
            options[i].disabled = true;
            
            // Nếu thương hiệu đang chọn bị ẩn đi (do đổi danh mục), thì reset về rỗng
            if(options[i].value == selectThuongHieu.value){
                selectThuongHieu.value = "";
            }
        }
    }
}

// CHẠY HÀM NAY NGAY LẬP TỨC KHI VÀO TRANG SỬA
// Để nó tự động ẩn các thương hiệu không phù hợp với danh mục hiện tại
window.onload = function() {
    filterBrands();
};