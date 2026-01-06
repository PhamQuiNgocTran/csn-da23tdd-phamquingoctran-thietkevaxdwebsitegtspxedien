<?php
    // Hàm hỗ trợ format văn bản đẹp (Tự động in đậm tiêu đề trước dấu :)
    function make_content_pretty($text) {
        $lines = explode("\n", $text); // Tách từng dòng
        $html = '';
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue; // Bỏ qua dòng trống
            
            // Kiểm tra: Nếu dòng có dấu ":" (Ví dụ: "Động cơ: 1000W")
            if (strpos($line, ':') !== false) {
                $parts = explode(':', $line, 2);
                // In đậm phần trước dấu :
                $html .= '<p class="mb-3"><strong class="text-dark">'.$parts[0].':</strong> '.$parts[1].'</p>';
            } else {
                // Dòng bình thường
                $html .= '<p class="mb-3">'.$line.'</p>';
            }
        }
        return $html;
    }

    $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc 
                    WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                    AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1";
    $query_chitiet = mysqli_query($conn, $sql_chitiet);
    
    while($row_chitiet = mysqli_fetch_array($query_chitiet)){
        $img_name = pathinfo($row_chitiet['hinhanh'], PATHINFO_FILENAME); 
        $img_ext = pathinfo($row_chitiet['hinhanh'], PATHINFO_EXTENSION); 
?>

<div class="detail-page-wrapper mt-4 shadow-sm rounded overflow-hidden">
    
    <div class="product-image-section">
        <div class="product-display-container">
            <img id="mainProductImage" 
                 src="admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh'] ?>" 
                 alt="<?php echo $row_chitiet['tensp'] ?>"
                 data-original="admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh'] ?>">
        </div>
    </div>

    <div class="product-info-section">
        <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
            
            <h1 class="detail-product-name"><?php echo $row_chitiet['tensp'] ?></h1>
            <div class="detail-product-code">
                Mã SP: <span class="fw-bold text-dark"><?php echo $row_chitiet['masp'] ?></span> | 
                Danh mục: <span class="fw-bold text-primary"><?php echo $row_chitiet['ten_danhmuc'] ?></span>
            </div>
            
            <div class="payment-info">
                <div class="price-label">Giá bán ưu đãi:</div>
                <div class="current-price">
                    <?php echo number_format($row_chitiet['giasp'],0,',','.').' VNĐ' ?>
                </div>
                <div class="tax-note"><i class="fas fa-check-circle"></i> Đã bao gồm VAT & Phí bảo hành</div>
            </div>

            <div class="color-options mt-4">
                <span>Màu sắc tùy chọn:</span>
                <div class="d-flex gap-2 flex-wrap">
                    <?php
                        $mang_mau = explode(',', $row_chitiet['mausac']);
                        foreach($mang_mau as $key => $mau){
                            $mau = trim($mau);
                            if($mau != ''){
                                $hinh_theo_mau = $img_name . '-' . $mau . '.' . $img_ext;
                    ?>
                        <input type="radio" class="btn-check color-selector" 
                               name="mausac_chon" 
                               id="color_<?php echo $key ?>" 
                               value="<?php echo $mau ?>" 
                               data-img="<?php echo $hinh_theo_mau ?>"
                               <?php if($key==0) echo 'checked' ?> required>
                        <label class="color-dot-label" for="color_<?php echo $key ?>">
                            <?php echo $mau ?>
                        </label>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" name="themgiohang" class="btn-buy-now-style">
                    <i class="fas fa-shopping-cart"></i> MUA NGAY
                </button>
                <p class="text-center mt-3 text-muted" style="font-size: 0.9rem;">
                    <i class="fas fa-truck"></i> Miễn phí vận chuyển toàn quốc
                </p>
            </div>
        </form>
    </div>
</div>

<div class="product-description-section mt-5 mb-5">
    <div class="container">
        <div class="description-box shadow-sm rounded overflow-hidden bg-white">
            <div class="description-header p-4 border-bottom">
                <h3 class="m-0 fw-bold text-uppercase d-flex align-items-center">
                    <i class="fas fa-info-circle me-3 text-danger"></i>
                    Chi tiết sản phẩm
                </h3>
            </div>
            
            <div class="description-content p-4 p-md-5">
                <?php if(!empty($row_chitiet['tomtat'])): ?>
                <div class="summary-box mb-4 p-3 bg-light rounded border-start border-4 border-danger">
                    <h5 class="fw-bold mb-3"><i class="far fa-bookmark me-2"></i>Điểm nổi bật</h5>
                    <div class="content-text text-dark">
                        <?php echo make_content_pretty($row_chitiet['tomtat']) ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="detail-content-box">
                    <h5 class="fw-bold mb-3"><i class="fas fa-list-alt me-2"></i>Thông số & Chi tiết</h5>
                    <div class="content-text text-secondary">
                         <?php echo make_content_pretty($row_chitiet['noidung']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
?>
