<?php
    //XỬ LÝ PHP
    if(isset($_POST['dangky'])){
        $tenkhachhang = $_POST['hovaten'];
        $email = $_POST['email'];
        $dienthoai = $_POST['dienthoai'];
        $matkhau = md5($_POST['matkhau']);
        $diachi = ""; 
        $sql_dangky = "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) VALUE('".$tenkhachhang."','".$email."','".$diachi."','".$matkhau."','".$dienthoai."')";
        $query_dangky = mysqli_query($conn, $sql_dangky);
        if($query_dangky){
            $_SESSION['dangky'] = $tenkhachhang;
            $_SESSION['id_khachhang'] = mysqli_insert_id($conn);
            echo '<script>alert("Đăng ký thành công!"); window.location.href="index.php";</script>';
        }
    }
    if(isset($_POST['dangnhap'])){
        $email = $_POST['email'];
        $matkhau = md5($_POST['password']);
        $sql = "SELECT * FROM tbl_dangky WHERE email='".$email."' AND matkhau='".$matkhau."' LIMIT 1";
        $row = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($row);
        if($count > 0){
            $row_data = mysqli_fetch_array($row);
            $_SESSION['dangky'] = $row_data['tenkhachhang'];
            $_SESSION['id_khachhang'] = $row_data['id_dangky'];
            echo '<script>window.location.href="index.php";</script>'; 
        }else{
            echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng!");</script>';
        }
    }
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']==1){
        unset($_SESSION['dangky']);
        unset($_SESSION['id_khachhang']);
        unset($_SESSION['cart']);
        header('Location:index.php');
    }
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js?v=<?php echo time(); ?>"></script>


<header id="myHeader" class="shadow-sm sticky-top" style="z-index: 1000;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid px-4">
            
            <a class="navbar-brand fw-bold fs-4 logo-text" href="index.php" style="font-family: Arial, sans-serif;">
                <i class="fas fa-cat"></i> XE ĐIỆN VIỆT
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="index.php">TRANG CHỦ</a>
                    </li>
                    
                    <li class="nav-item has-mega">
                        <a class="nav-link px-3" href="index.php?quanly=danhmuc&id=2">XE ĐẠP ĐIỆN</a>
                        <div class="mega-menu">
                            <div class="mega-content">
                                <h3>Xe đạp điện</h3>
                                <div class="brand-grid">
                                    <?php
                                    // Logic: Chỉ lấy những thương hiệu CÓ sản phẩm là Xe Đạp Điện (id_danhmuc = 2)
                                    $sql_menu_xedap = "SELECT DISTINCT t.id_thuonghieu, t.ten_thuonghieu 
                                                       FROM tbl_thuonghieu t 
                                                       JOIN tbl_sanpham s ON t.id_thuonghieu = s.thuonghieu 
                                                       WHERE s.id_danhmuc = '2' 
                                                       ORDER BY t.thutu ASC";
                                    $query_menu_xedap = mysqli_query($conn, $sql_menu_xedap);
                                    
                                    while($row_menu = mysqli_fetch_array($query_menu_xedap)){
                                    ?>
                                        <a href="index.php?quanly=thuonghieu&id_danhmuc=2&id_thuonghieu=<?php echo $row_menu['id_thuonghieu'] ?>">
                                            <?php echo $row_menu['ten_thuonghieu'] ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item has-mega">
                        <a class="nav-link px-3" href="index.php?quanly=danhmuc&id=1">XE MÁY ĐIỆN</a>
                        <div class="mega-menu">
                            <div class="mega-content">
                                <h3>Xe máy điện</h3>
                                <div class="brand-grid">
                                    <?php
                                    // Logic: Chỉ lấy những thương hiệu CÓ sản phẩm là Xe Máy Điện (id_danhmuc = 1)
                                    $sql_menu_xemay = "SELECT DISTINCT t.id_thuonghieu, t.ten_thuonghieu 
                                                       FROM tbl_thuonghieu t 
                                                       JOIN tbl_sanpham s ON t.id_thuonghieu = s.thuonghieu 
                                                       WHERE s.id_danhmuc = '1' 
                                                       ORDER BY t.thutu ASC";
                                    $query_menu_xemay = mysqli_query($conn, $sql_menu_xemay);
                                    
                                    while($row_menu = mysqli_fetch_array($query_menu_xemay)){
                                    ?>
                                        <a href="index.php?quanly=thuonghieu&id_danhmuc=1&id_thuonghieu=<?php echo $row_menu['id_thuonghieu'] ?>">
                                            <?php echo $row_menu['ten_thuonghieu'] ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    
                    <form class="d-flex custom-search" action="index.php?quanly=timkiem" method="POST" style="max-width: 250px;">
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="search" name="tukhoa" placeholder="Tìm xe..." required style="border: 1px solid #999; background-color: #fff;">
                            <button class="btn btn-danger" type="submit" name="timkiem">
                                <i class="fas fa-search text-white"></i>
                            </button>
                        </div>
                    </form>

                    <a href="index.php?quanly=giohang" class="position-relative text-decoration-none fs-5 icon-black">
                        <i class="fas fa-shopping-cart"></i>
                        <?php 
                            if(isset($_SESSION['cart'])){
                                $soluong_cart = 0;
                                foreach($_SESSION['cart'] as $cart_item){
                                    $soluong_cart += $cart_item['soluong'];
                                }
                        ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" style="font-size: 0.6rem;">
                                <?php echo $soluong_cart ?>
                            </span>
                        <?php } ?>
                    </a>

                    <ul class="navbar-nav">
                        <?php if(isset($_SESSION['dangky'])){ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-bold icon-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle text-danger"></i> <?php echo $_SESSION['dangky'] ?>
                                </a>
                                <ul class="dropdown-menu shadow" style="right: 0; left: auto;">
                                    <li>
                                        <a class="dropdown-item" href="index.php?quanly=lichsudonhang">
                                            <i class="fas fa-history text-muted me-2"></i> Lịch sử đơn hàng
                                        </a>
                                    </li>
                                    
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <li>
                                        <a class="dropdown-item" href="index.php?dangxuat=1">
                                            <i class="fas fa-sign-out-alt text-muted me-2"></i> Đăng xuất
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link fw-bold icon-black" href="#" data-bs-toggle="modal" data-bs-target="#modalLogin" style="font-size: 0.9rem;">
                                    <i class="fas fa-user"></i> Đăng nhập
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="modalLogin" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold">ĐĂNG NHẬP</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập email..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
            </div>
            <button type="submit" name="dangnhap" class="btn btn-danger w-100 fw-bold py-2">ĐĂNG NHẬP</button>
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <small>Chưa có tài khoản? <a href="#" class="text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalRegister">Đăng ký ngay</a></small>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRegister" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> 
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold">ĐĂNG KÝ TÀI KHOẢN</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Họ và tên</label>
                <input type="text" name="hovaten" class="form-control" placeholder="Nhập họ tên..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập email..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Số điện thoại</label>
                <input type="text" name="dienthoai" class="form-control" placeholder="Nhập số điện thoại..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mật khẩu</label>
                <input type="password" name="matkhau" class="form-control" placeholder="Tạo mật khẩu..." required>
            </div>
            <button type="submit" name="dangky" class="btn btn-danger w-100 fw-bold py-2">ĐĂNG KÝ</button>
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <small>Đã có tài khoản? <a href="#" class="text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin">Đăng nhập</a></small>
      </div>
    </div>
  </div>
</div>