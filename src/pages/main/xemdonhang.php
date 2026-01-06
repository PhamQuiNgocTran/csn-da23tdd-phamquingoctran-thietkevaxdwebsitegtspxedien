<?php
    $code = $_GET['code'];
    //Kết nối 3 bảng (Chi tiết, Sản phẩm, Đơn hàng)
    $sql_lietke_dh = "SELECT * FROM tbl_cart_details, tbl_sanpham, tbl_cart 
                      WHERE tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
                      AND tbl_cart_details.id_cart = tbl_cart.id_cart 
                      AND tbl_cart.code_cart = '".$code."' 
                      ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh = mysqli_query($conn, $sql_lietke_dh);
?>
<div class="container mt-4">
    <h4 class="mb-3">Chi tiết đơn hàng: <span class="text-danger"><?php echo $code ?></span></h4>
    
    <table class="table table-bordered shadow-sm">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $tongtien = 0;
            while($row = mysqli_fetch_array($query_lietke_dh)){
                $i++;
                // Tính thành tiền: Số lượng * Giá
                $thanhtien = $row['giasp'] * $row['soluongmua'];
                $tongtien += $thanhtien;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tensp'] ?></td>
                <td><img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="80px"></td>
                <td><?php echo $row['soluongmua'] ?></td>
                <td><?php echo number_format($row['giasp'],0,',','.').'vnđ' ?></td>
                <td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="5" class="text-end fw-bold">Tổng tiền:</td>
                <td class="fw-bold text-danger"><?php echo number_format($tongtien,0,',','.').'vnđ' ?></td>
            </tr>
        </tbody>
    </table>
    <a href="index.php?quanly=lichsudonhang" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i> Quay lại lịch sử đơn hàng</a>
</div>