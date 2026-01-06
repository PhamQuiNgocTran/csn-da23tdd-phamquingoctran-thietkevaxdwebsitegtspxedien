<div class="clear">
    <?php
        // 1. Khởi tạo và kiểm tra biến điều hướng $_GET['quanly']
        $tam = '';
        if(isset($_GET['action']) && $_GET['query']){
            $tam = $_GET['action'];
            $query = $_GET['query'];
        }else{
            $tam= '';
            $query= '';
        }
        if ($tam == 'quanlydanhmuc' && $query=='them') {
            // Hiển thị nội dung sản phẩm Yadea
            include('modules/quanlydanhmucsp/them.php');
            include('modules/quanlydanhmucsp/lietke.php');
        } else if($tam == 'quanlydanhmuc' && $query=='sua'){
            include('modules/quanlydanhmucsp/sua.php');
        }
        else if($tam == 'quanlysanpham' && $query=='them'){
             include('modules/quanlysp/them.php');
            include('modules/quanlysp/lietke.php');
        }else if($tam == 'quanlysp' && $query=='sua'){
            include('modules/quanlysp/sua.php');
        }else if ($tam == 'quanlydonhang' && $query == 'lietke') {
            include('modules/quanlydonhang/lietke.php');
        } else if ($tam == 'quanlydonhang' && $query == 'xemdonhang') {
            include('modules/quanlydonhang/xemdonhang.php');
        }
        else {
            // Mặc định, hiển thị sản phẩm nổi bật của trang chủ
            include('modules/dashboard.php');
        }
    ?>
</div>
