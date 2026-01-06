<?php
    // Kiểm tra xem khách đã đăng nhập chưa
    if(!isset($_SESSION['id_khachhang'])){
        echo '<div class="alert alert-warning">Vui lòng <a href="index.php?quanly=dangnhap">đăng nhập</a> để xem lịch sử đơn hàng.</div>';
    } else {
        $id_khachhang = $_SESSION['id_khachhang'];
        
        // --- SỬA LẠI TÊN CỘT Ở ĐÂY (id_dangky) ---
        $sql_lietke_dh = "SELECT * FROM tbl_cart WHERE id_dangky='$id_khachhang' ORDER BY id_cart DESC";
        $query_lietke_dh = mysqli_query($conn, $sql_lietke_dh);
?>
<div class="container mt-4">
    <h3 class="text-center text-uppercase fw-bold mb-4" style="color: #d90f1d;">Lịch sử đơn hàng của bạn</h3>
    
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="bg-danger text-white">
            <tr>
                <th>ID</th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Tình trạng</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            // Thêm kiểm tra nếu có đơn hàng mới hiển thị
            if(mysqli_num_rows($query_lietke_dh) > 0){
                while($row = mysqli_fetch_array($query_lietke_dh)){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['code_cart'] ?></td>
                <td><?php echo $row['cart_date'] ?></td> 
                <td>
                    <?php 
                        if($row['cart_status']==1){
                            echo '<span class="badge bg-secondary">Đơn hàng mới</span>';
                        }elseif($row['cart_status']==0){
                            echo '<span class="badge bg-success">Đã xử lý</span>';
                        }else{
                            echo '<span class="badge bg-danger">Đã hủy</span>';
                        }
                    ?>
                </td>
                <td>
                    <a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart'] ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                </td>
            </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="5" class="text-center">Bạn chưa có đơn hàng nào.</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
    }
?>