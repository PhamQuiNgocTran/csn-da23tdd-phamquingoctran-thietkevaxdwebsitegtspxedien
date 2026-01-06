<?php
include('../../config/config.php');

// 1. LẤY DỮ LIỆU TỪ FORM
$tensp = $_POST['tensanpham']; // Form gửi name="tensanpham", DB cần 'tensp'
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
$soluongban = isset($_POST['soluongban']) ? $_POST['soluongban'] : 0;
$mausac = $_POST['mausac'];
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc']; // id_danhmuc
$thuonghieu = $_POST['thuonghieu']; // id_thuonghieu

// Xử lý hình ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh_time = time().'_'.$hinhanh;

// --- XỬ LÝ THÊM ---
if(isset($_POST['themsanpham'])){
    
    // SQL chuẩn theo file webxedien_mysql (3).sql
    $sql_them = "INSERT INTO tbl_sanpham(tensp, masp, giasp, soluong, soluongban, mausac, hinhanh, tomtat, noidung, tinhtrang, id_danhmuc, thuonghieu) 
    VALUES('".$tensp."','".$masp."','".$giasp."','".$soluong."','".$soluongban."','".$mausac."','".$hinhanh_time."','".$tomtat."','".$noidung."','".$tinhtrang."','".$danhmuc."','".$thuonghieu."')";
    
    mysqli_query($conn, $sql_them) or die("Lỗi thêm: " . mysqli_error($conn));
    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);
    header('Location:../../index.php?action=quanlysp&query=them');

// --- XỬ LÝ SỬA ---
}elseif(isset($_POST['suasanpham'])){
    $id_sanpham = $_GET['idsanpham'];
    
    if($hinhanh != ''){
        // Có chọn ảnh mới -> Upload và xóa ảnh cũ
        move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);
        
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id_sanpham' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($query)){
            if(file_exists('uploads/'.$row['hinhanh'])){
                unlink('uploads/'.$row['hinhanh']);
            }
        }
        
        $sql_update = "UPDATE tbl_sanpham SET tensp='".$tensp."', masp='".$masp."', giasp='".$giasp."', soluong='".$soluong."', soluongban='".$soluongban."', mausac='".$mausac."', hinhanh='".$hinhanh_time."', tomtat='".$tomtat."', noidung='".$noidung."', tinhtrang='".$tinhtrang."', id_danhmuc='".$danhmuc."', thuonghieu='".$thuonghieu."' WHERE id_sanpham='$id_sanpham'";
    
    }else{
        // Không thay đổi ảnh
        $sql_update = "UPDATE tbl_sanpham SET tensp='".$tensp."', masp='".$masp."', giasp='".$giasp."', soluong='".$soluong."', soluongban='".$soluongban."', mausac='".$mausac."', tomtat='".$tomtat."', noidung='".$noidung."', tinhtrang='".$tinhtrang."', id_danhmuc='".$danhmuc."', thuonghieu='".$thuonghieu."' WHERE id_sanpham='$id_sanpham'";
    }
    
    mysqli_query($conn, $sql_update) or die("Lỗi sửa: " . mysqli_error($conn));
    header('Location:../../index.php?action=quanlysp&query=them');

// --- XỬ LÝ XÓA ---
}else{
    $id = $_GET['idsanpham'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($query)){
        if(file_exists('uploads/'.$row['hinhanh'])){
            unlink('uploads/'.$row['hinhanh']);
        }
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='".$id."'";
    mysqli_query($conn, $sql_xoa);
    header('Location:../../index.php?action=quanlysp&query=them');
}
?>