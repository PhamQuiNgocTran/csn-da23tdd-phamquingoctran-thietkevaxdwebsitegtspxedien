<p class="fs-4 fw-bold text-center text-uppercase mt-4" style="color: #d90f1d;">Giỏ hàng của bạn</p>

<?php
    if(isset($_SESSION['cart'])){
        $tongtien = 0;
?>

<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle shadow-sm">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Thông tin sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($_SESSION['cart'] as $cart_item){
                            $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                            $tongtien += $thanhtien;
                        ?>
                        <tr>
                            <td style="width: 100px;">
                                <img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" width="100%" class="rounded">
                            </td>
                            
                            <td class="text-start">
                                <p class="fw-bold mb-1"><?php echo $cart_item['tensp'] ?></p>
                                <p class="mb-1 text-muted small">Mã: <?php echo $cart_item['masp'] ?></p>
                                <p class="mb-1 text-muted small">Màu: <span class="badge bg-light text-dark border"><?php echo $cart_item['mausac'] ?></span></p>
                                <p class="fw-bold text-danger mb-0"><?php echo number_format($cart_item['giasp'],0,',','.').'đ' ?></p>
                            </td>

                            <td style="width: 120px;">
                                <div class="d-flex justify-content-center align-items-center border rounded">
                                    <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>" class="btn btn-sm text-secondary"><i class="fas fa-minus"></i></a>
                                    <span class="mx-2 fw-bold"><?php echo $cart_item['soluong'] ?></span>
                                    <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>" class="btn btn-sm text-secondary"><i class="fas fa-plus"></i></a>
                                </div>
                            </td>

                            <td class="fw-bold"><?php echo number_format($thanhtien,0,',','.').'đ' ?></td>

                            <td>
                                <a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>" class="text-secondary" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <tr>
                            <td colspan="5" class="text-end border-0">
                                <a href="pages/main/themgiohang.php?xoatatca=1" class="btn btn-sm btn-outline-danger">Xóa tất cả</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Đơn hàng</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span class="fw-bold"><?php echo number_format($tongtien,0,',','.').' đ' ?></span>
                    </div>

                    <div class="d-flex justify-content-between mb-4 mt-3">
                        <span class="fs-5 fw-bold text-danger">TỔNG TIỀN:</span>
                        <span class="fs-4 fw-bold text-danger"><?php echo number_format($tongtien,0,',','.').' đ' ?></span>
                    </div>

                    <div class="d-grid gap-2">
                        <?php if(isset($_SESSION['dangky'])){ ?>
                            <a href="index.php?quanly=vanchuyen" class="btn btn-danger py-2 fw-bold text-uppercase">
                                TIẾN HÀNH ĐẶT HÀNG
                            </a>
                        <?php } else { ?>
                            <button type="button" class="btn btn-danger py-2 fw-bold text-uppercase" data-bs-toggle="modal" data-bs-target="#modalLogin">
                                ĐĂNG NHẬP ĐỂ ĐẶT HÀNG
                            </button>
                            <div class="text-center mt-2">
                                <small>Chưa có tài khoản? <a href="#" class="text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalRegister">Đăng ký ngay</a></small>
                            </div>
                        <?php } ?>
                        
                        <a href="index.php" class="btn btn-outline-secondary mt-2">
                            <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
    } else {
?>
    <div class="container text-center my-5">
        <img src="https://bizweb.dktcdn.net/100/364/597/themes/734268/assets/empty-cart.png" alt="Giỏ hàng trống" style="width: 150px; opacity: 0.7;">
        <p class="mt-3 fs-5 text-muted">Giỏ hàng của bạn đang trống</p>
        <a href="index.php" class="btn btn-danger fw-bold px-4">MUA SẮM NGAY</a>
    </div>
<?php
    }
?>