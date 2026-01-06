<?php
    session_start();
    // 1. KIỂM TRA ĐĂNG NHẬP
    if(!isset($_SESSION['dangnhap'])){
        header('Location:login.php');
    }

    // 2. XỬ LÝ ĐĂNG XUẤT (Khi bấm nút Đăng xuất ở Menu)
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']==1){
        unset($_SESSION['dangnhap']);
        header('Location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="css/style_admin.css"> 
</head>
<body>
    
    <div class="wrapper">
        <div class="sidebar">
            <h3>Admin Panel</h3>
            <?php 
                // SỬA: Dùng file menu.php thay vì header.php
                include("modules/header.php"); 
            ?>
        </div>

        <div class="main-content">
            <h2 class="header-admin">Welcome to Dashboard</h2>
            <?php 
                // SỬA: Đảm bảo đúng tên file kết nối (connect.php hay config.php)
                include("config/config.php"); 
                include("modules/main.php");
            ?>
        </div>
    </div>

</body>
</html>