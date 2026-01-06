<?php
    $code = isset($_GET['code']) ? $_GET['code'] : '';

    // 1. Lấy thông tin chi tiết sản phẩm
    // Sử dụng INNER JOIN và chỉ định rõ cột lấy để tránh lỗi trùng lặp
    $sql_lietke_dh = "SELECT tbl_cart_details.*, tbl_sanpham.tensp, tbl_sanpham.hinhanh, tbl_cart.code_cart 
                      FROM tbl_cart_details 
                      INNER JOIN tbl_cart ON tbl_cart_details.id_cart = tbl_cart.id_cart 
                      INNER JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
                      WHERE tbl_cart.code_cart = '".$code."' 
                      ORDER BY tbl_cart_details.id_cart_details DESC";
                      
    $query_lietke_dh = mysqli_query($conn, $sql_lietke_dh);
    
    // Kiểm tra lỗi SQL nếu có
    if (!$query_lietke_dh) {
        echo "<div class='alert alert-danger'>Lỗi SQL: " . mysqli_error($conn) . "</div>";
        exit();
    }
?>

<div class="container mt-4">
    <p class="fs-4 fw-bold mb-3">Chi tiết đơn hàng: <span class="text-danger"><?php echo $code ?></span></p>

    <table class="table table-bordered table-hover shadow-sm align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá lúc mua</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            $i = 0;
            $tongtien = 0; 
            
            if(mysqli_num_rows($query_lietke_dh) > 0){
                while($row = mysqli_fetch_array($query_lietke_dh)){
                    $i++;
                    // SỬA QUAN TRỌNG: Dùng 'dongia' (giá lưu trong đơn hàng) thay vì 'giasp' (giá hiện tại)
                    // Để đảm bảo chính xác lịch sử giao dịch
                    $thanhtien = $row['dongia'] * $row['soluongmua'];
                    $tongtien += $thanhtien;
            ?>
            <tr class="text-center bg-white">
                <td><?php echo $i ?></td>
                <td><?php echo $row['code_cart'] ?></td>
                <td class="fw-bold"><?php echo $row['tensp'] ?></td>
                <td>
                    <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="80px" style="object-fit: contain; border-radius: 5px;">
                </td>
                <td><?php echo $row['soluongmua'] ?></td>
                <td class="text-end"><?php echo number_format($row['dongia'],0,',','.').'đ' ?></td>
                <td class="text-end fw-bold"><?php echo number_format($thanhtien,0,',','.').'đ' ?></td>
            </tr>
            <?php
                } 
            } else {
                echo '<tr><td colspan="7" class="text-center text-muted">Không tìm thấy chi tiết đơn hàng</td></tr>';
            }
            ?>

            <tr class="table-warning">
                <td colspan="6" class="text-end fw-bold fs-5">TỔNG TIỀN THANH TOÁN:</td>
                <td class="text-end fw-bold fs-5 text-danger">
                    <?php echo number_format($tongtien,0,',','.').'đ' ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="mt-3 mb-4">
        <a href="index.php?action=quanlydonhang&query=lietke" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        <button onclick="window.print()" class="btn btn-primary ms-2"><i class="fas fa-print"></i> In hóa đơn</button>
    </div>
</div>