<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
    // Kiểm tra đăng nhập
    if(!isset($_SESSION['id_khachhang'])){
        echo '<script>alert("Vui lòng đăng nhập để thanh toán!"); window.location.href="index.php?quanly=giohang";</script>';
    }

    $id_dangky = $_SESSION['id_khachhang'];
    $sql_user = "SELECT * FROM tbl_dangky WHERE id_dangky='$id_dangky' LIMIT 1";
    $query_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_array($query_user);
?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="progress" style="height: 30px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%">1. Giỏ hàng</div>
                <div class="progress-bar bg-danger fw-bold" role="progressbar" style="width: 50%">2. Vận chuyển & Thanh toán</div>
            </div>
        </div>
    </div>

    <form action="pages/main/thanhtoan.php" method="POST">
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-map-marker-alt"></i> THÔNG TIN NHẬN HÀNG</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Người nhận</label>
                                <input type="text" name="tennguoinhan" class="form-control" value="<?php echo $row_user['tenkhachhang'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="dienthoai" class="form-control" value="<?php echo $row_user['dienthoai'] ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-danger">Địa chỉ giao hàng</label>
                            
                            <?php if(!empty($row_user['diachi'])){ ?>
                                <div class="alert alert-warning small py-2 mb-2">
                                    <i class="fas fa-history"></i> Địa chỉ cũ: <b><?php echo $row_user['diachi'] ?></b>
                                    <br>
                                    (Chọn bên dưới nếu muốn giao đến nơi khác)
                                </div>
                                <input type="hidden" name="diachi_cu" value="<?php echo $row_user['diachi'] ?>">
                            <?php } else { ?>
                                <input type="hidden" name="diachi_cu" value="">
                            <?php } ?>

                            <div class="row g-2 mb-2">
                                <div class="col-md-4">
                                    <select class="form-select css_select" id="tinh" name="tinh" title="Chọn Tỉnh Thành" required>
                                        <option value="0">Tỉnh Thành</option>
                                    </select> 
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select css_select" id="quan" name="quan" title="Chọn Quận Huyện" required>
                                        <option value="0">Quận Huyện</option>
                                    </select> 
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select css_select" id="phuong" name="phuong" title="Chọn Phường Xã" required>
                                        <option value="0">Phường Xã</option>
                                    </select> 
                                </div>
                            </div>

                            <input type="text" id="sonha" class="form-control" placeholder="Số nhà, tên đường cụ thể..." required>
                            
                            <input type="hidden" name="diachi_moi" id="diachi_full">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú đơn hàng</label>
                            <textarea name="ghichu" class="form-control" rows="2" placeholder="Ví dụ: Giao giờ hành chính, gọi trước khi giao..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm mb-3 border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-truck"></i> HÌNH THỨC VẬN CHUYỂN</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-2 p-3 border rounded">
                            <input class="form-check-input" type="radio" name="vanchuyen" id="vc1" value="Giao hàng tiêu chuẩn" checked>
                            <label class="form-check-label fw-bold" for="vc1">
                                <i class="fas fa-box text-primary"></i> Giao hàng tiêu chuẩn (Toàn quốc)
                            </label>
                            <div class="small text-muted ms-4">Miễn phí vận chuyển - Dự kiến 3-5 ngày</div>
                        </div>
                        
                        <div class="form-check p-3 border rounded">
                            <input class="form-check-input" type="radio" name="vanchuyen" id="vc2" value="Giao hàng hỏa tốc">
                            <label class="form-check-label fw-bold" for="vc2">
                                <i class="fas fa-shipping-fast text-danger"></i> Giao hàng Hỏa tốc (Nội thành)
                            </label>
                            <div class="small text-muted ms-4">Nhận trong ngày - Phí ship thực tế</div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">TÓM TẮT ĐƠN HÀNG</h5>
                        <?php
                            $tongtien = 0;
                            foreach($_SESSION['cart'] as $cart_item){
                                $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                                $tongtien += $thanhtien;
                        ?>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span><?php echo $cart_item['tensp'] ?> (x<?php echo $cart_item['soluong'] ?>)</span>
                                <b><?php echo number_format($thanhtien,0,',','.').'đ' ?></b>
                            </div>
                        <?php } ?>
                        <hr>
                        
                        <?php
                            $tiengiam = 0;
                            if(isset($_SESSION['khuyenmai'])){
                                if($_SESSION['khuyenmai']['loai'] == 1){
                                    $tiengiam = ($tongtien * $_SESSION['khuyenmai']['sogiam']) / 100;
                                } else {
                                    $tiengiam = $_SESSION['khuyenmai']['sogiam'];
                                }
                        ?>
                            <div class="d-flex justify-content-between text-success mb-2">
                                <span>Giảm giá:</span>
                                <span>- <?php echo number_format($tiengiam,0,',','.').' đ' ?></span>
                            </div>
                        <?php } ?>
                        
                        <div class="d-flex justify-content-between mb-4 mt-3">
                            <span class="fw-bold fs-5 text-danger">TỔNG THANH TOÁN:</span>
                            <span class="fw-bold fs-4 text-danger"><?php echo number_format($tongtien - $tiengiam,0,',','.').' đ' ?></span>
                        </div>

                        <button type="submit" name="xacnhan_donhang" class="btn btn-danger w-100 py-3 fw-bold fs-5 text-uppercase">
                            ĐẶT HÀNG NGAY
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
