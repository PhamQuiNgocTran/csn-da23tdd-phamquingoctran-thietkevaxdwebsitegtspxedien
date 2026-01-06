<?php
// 1. SQL lấy sản phẩm cho trang chủ (SẢN PHẨM NỔI BẤT)
// Lấy 8 sản phẩm mới nhất để chia đều cho 4 cột (2 hàng)
$sql_pro = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT 8";
$query_pro = mysqli_query($conn, $sql_pro);
?>

<h3 class="text-center fw-bold text-uppercase mb-4 mt-5 py-3" style="color: #000000ff;">
    SẢN PHẨM NỔI BẬT
</h3>

<div class="container">
    
    <div class="row">
    <?php
    if (mysqli_num_rows($query_pro) > 0) {
        while ($row = mysqli_fetch_array($query_pro)) {
    ?>
        <div class="col-lg-3 col-md-3 col-6 mb-5">
            <div class="card h-100 shadow-sm border-0">

                <div style="height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img 
                        src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" 
                        alt="<?php echo $row['tensp'] ?>" 
                        style="max-width: 100%; max-height: 100%; object-fit: contain;"
                    >
                </div>

                <div class="d-flex justify-content-center pt-2">
                    <span style="width:10px; height:10px; background:#d90f1d; border-radius:50%; margin:0 3px;"></span>
                    <span style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
                    <span style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
                </div>

                <div class="card-body d-flex flex-column text-center p-3">
                    <h5 
                        class="fw-bold mb-1 text-uppercase"
                        style="
                            font-size: 1rem; /* Giảm font chữ 1 xíu cho gọn */
                            min-height: 40px; /* Giảm chiều cao tối thiểu xuống xíu */
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            line-height: 1.3; /* Chỉnh dòng khít lại */
                        "
                    >
                        <?php echo $row['tensp'] ?>
                    </h5>

                    <p class="text-danger fw-bold mb-2" style="font-size: 1.1rem;">
                        <?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ' ?>
                    </p>

                    <a 
                        href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>" 
                        class="btn custom-buy-btn mt-auto py-2"
                        style="font-size: 0.8rem;"
                    >
                        CHỌN MUA SẢN PHẤM <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        echo '<div class="col-12"><div class="alert alert-warning text-center">Hiện chưa có sản phẩm nào.</div></div>';
    }
    ?>
    </div>

</div>
