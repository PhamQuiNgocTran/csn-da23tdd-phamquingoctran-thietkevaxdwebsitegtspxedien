<?php
    session_start();
    // Gọi file cấu hình ngay đầu tiên
    include("admincp/config/config.php"); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Xe Điện</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <?php
            // Gọi Header
            include("pages/header.php");
            
            // Logic hiển thị Banner: Chỉ hiện ở trang chủ (khi không có biến 'quanly')
            if(!isset($_GET['quanly'])){
                include("pages/seaction.php");
            }
            
            // Nội dung chính
            include("pages/main.php");
            
            // Chân trang
            include("pages/footer.php");
        ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>