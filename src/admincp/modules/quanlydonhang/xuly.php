<?php
include('../../config/config.php');

if(isset($_GET['code'])){
    $code_cart = $_GET['code'];
    
    // Cập nhật trạng thái về 0 (Đã xử lý/Đã giao hàng)
    $sql_update = "UPDATE tbl_cart SET cart_status=0 WHERE code_cart='".$code_cart."'";
    mysqli_query($conn, $sql_update);

    // Quay lại trang danh sách đơn hàng
    header('Location:../../index.php?action=quanlydonhang&query=lietke');
}
?>