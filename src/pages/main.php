<div id="main">
    <div class="main-content">
        <?php
        if(isset($_GET['quanly'])){
            $tam = $_GET['quanly'];
        }else{
            $tam = '';
        }

        // --- BẮT ĐẦU ĐIỀU KIỆN ---

        if($tam=='danhmuc'){
            include("main/danhmuc.php");

        }else if($tam=='giohang'){
            include("main/giohang.php");

        }else if($tam=='thuonghieu'){ 
            include("main/thuonghieu.php"); 

        }else if($tam=='sanpham'){
            include("main/sanpham.php"); 

        }else if($tam=='timkiem'){
            include("main/timkiem.php");

        }elseif($tam == 'vanchuyen'){ 
            include("main/vanchuyen.php");
        
        }else if($tam=='thanhtoan'){
            include("main/thanhtoan.php"); 
        }
            else if($tam=='camon'){
            include("main/camon.php");   
        
        }else if($tam == 'lichsudonhang'){
            include("main/lichsudonhang.php");

        }else if($tam == 'xemdonhang'){
            include("main/xemdonhang.php");

        }else{
            // --- TRANG CHỦ ---
            include("main/sanphamnoibat.php"); 
        }
        ?>
    </div>
</div>