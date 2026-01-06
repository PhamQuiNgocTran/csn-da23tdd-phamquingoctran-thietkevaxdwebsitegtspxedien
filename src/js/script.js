// 1. Khai báo API chuẩn (Base URL)
const host = "https://provinces.open-api.vn/api/";

$(document).ready(function() {
    // ----------------------------------------------------------------
    // 1. LẤY DANH SÁCH TỈNH / THÀNH PHỐ
    // ----------------------------------------------------------------
    $.getJSON(host + '?depth=1', function(data) {
        renderData(data, "tinh");
    });

    // ----------------------------------------------------------------
    // 2. KHI CHỌN TỈNH -> LẤY QUẬN / HUYỆN
    // ----------------------------------------------------------------
    $("#tinh").change(function() {
        var tinh_code = $(this).val();
        
        if (tinh_code != "" && tinh_code != 0) {
            // API V2: Lấy Districts bằng cách gọi depth=2 từ Province
            $.getJSON(host + 'p/' + tinh_code + '?depth=2', function(data) {
                // V2 trả về object Province, mảng quận nằm trong key 'districts'
                renderData(data.districts, "quan");
            });
            // Reset phường xã
            printResult("phuong", []);
        } else {
            printResult("quan", []);
            printResult("phuong", []);
        }
        capNhatDiaChi();
    });

    // ----------------------------------------------------------------
    // 3. KHI CHỌN QUẬN -> LẤY PHƯỜNG / XÃ
    // ----------------------------------------------------------------
    $("#quan").change(function() {
        var quan_code = $(this).val();
        
        if (quan_code != "" && quan_code != 0) {
            // API V2: Lấy Wards bằng cách gọi depth=2 từ District
            $.getJSON(host + 'd/' + quan_code + '?depth=2', function(data) {
                // V2 trả về object District, mảng phường nằm trong key 'wards'
                renderData(data.wards, "phuong");
            });
        } else {
            printResult("phuong", []);
        }
        capNhatDiaChi();
    });

    // ----------------------------------------------------------------
    // 4. SỰ KIỆN KHÁC
    // ----------------------------------------------------------------
    $("#phuong").change(function() {
        capNhatDiaChi();
    });
    
    // Bắt sự kiện gõ phím số nhà
    $("#sonha").on('input', function() {
        capNhatDiaChi();
    });
});


// --- HÀM HỖ TRỢ HIỂN THỊ (RENDER) ---
var renderData = (array, select) => {
    let row = '';
    
    // Tạo dòng chọn mặc định
    if(select == "tinh"){
        row = '<option value="">Tỉnh Thành</option>';
    } else if (select == "quan"){
        row = '<option value="">Quận Huyện</option>';
    } else {
        row = '<option value="">Phường Xã</option>';
    }
    
    // Vòng lặp in dữ liệu
    $.each(array, function(index, element) {
        row += `<option value="${element.code}">${element.name}</option>`;
    });
    
    // Gán HTML vào thẻ select
    $("#" + select).html(row);
}

// Hàm reset ô chọn về rỗng
var printResult = (select, array) => {
    renderData(array, select);
}

// --- HÀM GỘP ĐỊA CHỈ GỬI VỀ DATABASE ---
function capNhatDiaChi() {
    // Lấy tên (text) của các ô đã chọn
    var tinh = $("#tinh option:selected").text();
    var quan = $("#quan option:selected").text();
    var phuong = $("#phuong option:selected").text();
    var sonha = $("#sonha").val();

    // Kiểm tra nếu chưa chọn thì gán rỗng
    if ($("#tinh").val() == "" || $("#tinh").val() == 0) tinh = "";
    if ($("#quan").val() == "" || $("#quan").val() == 0) quan = "";
    if ($("#phuong").val() == "" || $("#phuong").val() == 0) phuong = "";

    // Gộp chuỗi
    var diachi_gop = sonha + ", " + phuong + ", " + quan + ", " + tinh;
    
    // Xử lý chuỗi cho sạch (xóa các dấu phẩy dư thừa)
    while (diachi_gop.includes(", ,")) {
        diachi_gop = diachi_gop.replace(", ,", ",");
    }
    if (diachi_gop.startsWith(", ")) diachi_gop = diachi_gop.substring(2);
    if (diachi_gop.endsWith(", ")) diachi_gop = diachi_gop.substring(0, diachi_gop.length - 2);

    // Gán giá trị cuối cùng vào input hidden để PHP lấy được
    $("#diachi_full").val(diachi_gop);
}
/*Sanpham chitietmota */
 $(document).ready(function(){
        var originalSrc = $('#mainProductImage').attr('src');
        $('#mainProductImage').data('original', originalSrc);

        $('.color-selector').change(function(){
            var img_name = $(this).data('img');
            var new_src = "admincp/modules/quanlysp/uploads/" + img_name;
            $('#mainProductImage').attr('src', new_src);

            $('#mainProductImage').on('error', function(){
                var original_src = $(this).data('original');
                $(this).attr('src', original_src);
            });
        });
    });
