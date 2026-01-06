<?php
    $tukhoa = isset($_POST['tukhoa']) ? $_POST['tukhoa'] : '';
    // Xử lý chống lỗi ký tự đặc biệt
    $tukhoa_clean = mysqli_real_escape_string($conn, $tukhoa);
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE tensp LIKE '%".$tukhoa_clean."%'";
    $query_pro = mysqli_query($conn, $sql_pro);
?>

<div class="container mt-4 mb-3">
    <div style="font-size: 15px; color: #555;">
        Kết quả tìm kiếm cho: <strong style="color: #d90f1d;">'<?php echo $tukhoa ?>'</strong>
    </div>
</div>
<div class="container">
<div class="row">
    <?php 
    if(mysqli_num_rows($query_pro) > 0){ 
        while($row = mysqli_fetch_array($query_pro)){ 
    ?>
    <div class="col-lg-3 col-md-3 col-6 mb-5">
        <div class="card h-100 shadow-sm border-0">
            <div style="height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
            
            <div class="d-flex justify-content-center pt-2">
                <span class="product-dot active" style="width:10px; height:10px; background:#d90f1d; border-radius:50%; margin:0 3px;"></span>
                <span class="product-dot" style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
                <span class="product-dot" style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
            </div>
            
            <div class="card-body d-flex flex-column text-center">
                <h5 class="fw-bold mb-2 text-uppercase" style="font-size: 1rem; min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.3;">
                    <?php echo $row['tensp'] ?>
                </h5>
                <p class="text-danger fw-bold mb-4" style="font-size: 1.1rem;">
                    <?php echo number_format($row['giasp'],0,',','.').' VNĐ' ?>
                </p>
                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>" class="btn custom-buy-btn mt-auto py-2" style="font-size: 0.8rem;">
                    CHỌN MUA SẢN PHẨM <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <?php 
        }
    } else { 
        // Thông báo đẹp khi không tìm thấy
        echo '
        <div class="col-12 text-center py-5">
            <div class="alert alert-light" style="background-color: #f8f9fa;">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <p class="text-muted">Rất tiếc, chúng tôi không tìm thấy sản phẩm nào phù hợp với từ khóa <strong>"'.$tukhoa.'"</strong></p>
            </div>
        </div>'; 
    } 
    ?>
</div>
</div>
