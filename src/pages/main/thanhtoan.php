<?php
    session_start();
    include('../../admincp/config/config.php');

    if(isset($_POST['xacnhan_donhang']) && isset($_SESSION['id_khachhang'])){
        
        $id_khachhang = $_SESSION['id_khachhang'];
        $code_order = rand(0,9999); 
        $now = date('Y-m-d H:i:s');
        
        // 1. LẤY DỮ LIỆU TỪ FORM
        $ten_nhan = $_POST['tennguoinhan'];
        $sdt_nhan = $_POST['dienthoai'];
        $hinhthuc_vc = $_POST['vanchuyen'];
        $ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
        
        // Xử lý địa chỉ
        $diachi_moi = $_POST['diachi_moi'];
        $diachi_cu = $_POST['diachi_cu'];
        
        if(trim($diachi_moi) != ""){
            $diachi_final = $diachi_moi;
        } else {
            $diachi_final = $diachi_cu;
        }

        // 2. CẬP NHẬT LẠI THÔNG TIN KHÁCH HÀNG
        $sql_update_user = "UPDATE tbl_dangky SET tenkhachhang='".$ten_nhan."', dienthoai='".$sdt_nhan."', diachi='".$diachi_final."' WHERE id_dangky='".$id_khachhang."'";
        mysqli_query($conn, $sql_update_user);

        // 3. TẠO ĐƠN HÀNG MỚI (tbl_cart)
        // ĐÃ XÓA: Cột cart_coupon và logic lấy mã giảm giá
        $insert_cart = "INSERT INTO tbl_cart(id_dangky, code_cart, cart_status, cart_date, cart_shipping, cart_payment) 
        VALUES('".$id_khachhang."','".$code_order."',1, '".$now."', '".$hinhthuc_vc."', 'Tiền mặt')";
        
        $cart_query = mysqli_query($conn, $insert_cart);

        if($cart_query){
            // Lấy ID tự tăng của đơn hàng vừa tạo
            $id_cart = mysqli_insert_id($conn); 

            // 4. LƯU CHI TIẾT ĐƠN HÀNG (tbl_cart_details)
            foreach($_SESSION['cart'] as $key => $value){
                $id_sanpham = $value['id'];
                $soluong = $value['soluong'];
                $giasp = $value['giasp'];

                $insert_order_details = "INSERT INTO tbl_cart_details(id_cart, id_sanpham, soluongmua, dongia) 
                                         VALUES('".$id_cart."','".$id_sanpham."','".$soluong."','".$giasp."')";
                mysqli_query($conn, $insert_order_details);
            }
        }

        // 5. XÓA GIỎ HÀNG & CHUYỂN TRANG
        unset($_SESSION['cart']);       
        
        header('Location:../../index.php?quanly=camon');
    
    } else {
        header('Location:../../index.php?quanly=giohang'); 
    }
?>