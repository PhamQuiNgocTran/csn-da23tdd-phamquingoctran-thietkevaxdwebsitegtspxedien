<?php
    session_start();
    include('../../admincp/config/config.php');

    // 1. CỘNG SỐ LƯỢNG (Khi bấm dấu + trong giỏ hàng)
    if(isset($_GET['cong'])){
        $id = $_GET['cong'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $id){
                $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$cart_item['mausac']);
            }else{
                $tangsoluong = $cart_item['soluong'] + 1;
                // Nếu muốn giới hạn số lượng (ví dụ max 10 xe) thì if ở đây
                $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$cart_item['mausac']);
            }
        }
        $_SESSION['cart'] = $product;
        header('Location:../../index.php?quanly=giohang');
    }

    // 2. TRỪ SỐ LƯỢNG (Khi bấm dấu - trong giỏ hàng)
    if(isset($_GET['tru'])){
        $id = $_GET['tru'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $id){
                $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$cart_item['mausac']);
            }else{
                $trusoluong = $cart_item['soluong'] - 1;
                if($trusoluong > 0){
                    $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$trusoluong,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$cart_item['mausac']);
                }else{
                    // Nếu trừ về 0 thì coi như xóa luôn sản phẩm đó
                    // Không làm gì cả (không push vào mảng product) -> Tự mất
                }
            }
        }
        // Kiểm tra nếu xóa hết thì unset session luôn
        if(empty($product)){
            unset($_SESSION['cart']);
        }else{
            $_SESSION['cart'] = $product;
        }
        header('Location:../../index.php?quanly=giohang');
    }

    // 3. XÓA SẢN PHẨM (Dấu thùng rác)
    if(isset($_SESSION['cart']) && isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $id){
                $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$cart_item['mausac']);
            }
        }
        if(empty($product)){
             unset($_SESSION['cart']);
        }else{
            $_SESSION['cart'] = $product;
        }
        header('Location:../../index.php?quanly=giohang');
    }

    // 4. XÓA TẤT CẢ
    if(isset($_GET['xoatatca']) && $_GET['xoatatca']==1){
        unset($_SESSION['cart']);
        header('Location:../../index.php?quanly=giohang');
    }

    // 5. THÊM VÀO GIỎ HÀNG
    if(isset($_POST['themgiohang'])){
        // Lấy ID sản phẩm từ URL
        $id = $_GET['idsanpham'];
        // Mặc định số lượng là 1 (vì form chi tiết của bạn không có ô nhập số lượng)
        $soluong = 1; 
        
        // Lấy màu sắc từ Radio Button (quan trọng)
        $mau_sac = isset($_POST['mausac_chon']) ? $_POST['mausac_chon'] : 'Ngẫu nhiên';

        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='".$id."' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);

        if($row){
            $new_product = array(array(
                'tensp' => $row['tensp'],
                'id' => $id,
                'soluong' => $soluong,
                'giasp' => $row['giasp'],
                'hinhanh' => $row['hinhanh'],
                'masp' => $row['masp'],
                'mausac' => $mau_sac // Lưu màu khách chọn vào session
            ));

            // Kiểm tra giỏ hàng đã tồn tại chưa
            if(isset($_SESSION['cart'])){
                $found = false;
                foreach($_SESSION['cart'] as $cart_item){
                    // Nếu dữ liệu trùng ID 
                    // (Ở đồ án cơ bản, ta tạm chấp nhận trùng ID là tăng số lượng, dù khác màu)
                    // Nếu muốn chuyên sâu: phải so sánh cả ID và Màu Sắc
                    if($cart_item['id'] == $id){
                        $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong']+1,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$mau_sac);
                        $found = true;
                    }else{
                        // Giữ nguyên các sản phẩm khác
                        $product[] = array('tensp'=>$cart_item['tensp'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp'],'mausac'=>$cart_item['mausac']);
                    }
                }
                if($found == false){
                    // Liên kết dữ liệu cũ + mới
                    $_SESSION['cart'] = array_merge($product, $new_product);
                }else{
                    $_SESSION['cart'] = $product;
                }
            }else{
                // Nếu chưa có giỏ hàng thì tạo mới
                $_SESSION['cart'] = $new_product;
            }
        }
        header('Location:../../index.php?quanly=giohang');
    }
?>