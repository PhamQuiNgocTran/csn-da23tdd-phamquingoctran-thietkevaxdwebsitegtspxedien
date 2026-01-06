<?php
    // Lấy 8 sản phẩm bán chạy nhất
    $sql_pro = "SELECT * FROM tbl_sanpham ORDER BY soluongban DESC LIMIT 8";
    $query_pro = mysqli_query($conn, $sql_pro);
?>

<div class="row mt-4 mb-4">
    <div class="col-12">
        <h3 class="text-uppercase fw-bold text-center" style="letter-spacing: 1px; color: #000;">
            SẢN PHẨM NỔI BẬT
        </h3>
        <div style="width: 60px; height: 3px; background: #d90f1d; margin: 10px auto;"></div>
    </div>
</div>
<div class="container">
<div class="row">
    <?php
    while($row = mysqli_fetch_array($query_pro)){
    ?>
    
    <div class="col-lg-3 col-md-3 col-6 mb-5">
        <div class="card h-100 shadow-sm border-0">
            
            <div style="height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <img 
                    src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" 
                    alt="<?php echo $row['tensp'] ?>" 
                    class="img-fluid" 
                    style="max-height: 100%; object-fit: contain;"
                >
            </div>

            <div class="d-flex justify-content-center pt-2">
                <span style="width:10px; height:10px; background:#d90f1d; border-radius:50%; margin:0 3px;"></span>
                <span style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
                <span style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
            </div>

            <div class="card-body d-flex flex-column text-center p-3">
                <h5 class="fw-bold mb-1 text-uppercase" style="font-size: 1rem; min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.3;">
                    <?php echo $row['tensp'] ?>
                </h5>

                <p class="text-danger fw-bold mb-2" style="font-size: 1.1rem;">
                    <?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ' ?>
                </p>

                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>" class="btn custom-buy-btn mt-auto py-2" style="font-size: 0.8rem;">
                    CHỌN MUA SẢN PHẨM <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</div>