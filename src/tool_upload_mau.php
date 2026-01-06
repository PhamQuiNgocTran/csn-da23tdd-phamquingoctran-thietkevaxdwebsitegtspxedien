<?php
// 1. KẾT NỐI DATABASE
$mysqli = new mysqli("localhost","root","","webxedien_mysql");
if ($mysqli->connect_errno) {
  echo "Kết nối lỗi: " . $mysqli->connect_error;
  exit();
}

// 2. XỬ LÝ UPLOAD
$msg = "";
if(isset($_POST['upload_btn'])){
    $id_sanpham = $_POST['id_sanpham'];
    $ten_mau = trim($_POST['ten_mau']);
    $file = $_FILES['hinhanh_mau'];

    if($id_sanpham && $ten_mau && $file['name']){
        // Lấy thông tin ảnh gốc từ DB
        $sql = "SELECT hinhanh FROM tbl_sanpham WHERE id_sanpham = '$id_sanpham' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);

        if($row){
            // Lấy tên file gốc (Bỏ đuôi .jpg)
            $img_name_goc = pathinfo($row['hinhanh'], PATHINFO_FILENAME);
            $img_ext_goc = pathinfo($row['hinhanh'], PATHINFO_EXTENSION);
            
            // Tạo tên mới chuẩn quy tắc: TenGoc-TenMau.duoi
            $new_filename = $img_name_goc . '-' . $ten_mau . '.' . $img_ext_goc;
            $target_dir = "admincp/modules/quanlysp/uploads/";
            $target_file = $target_dir . $new_filename;

            // Upload và đổi tên
            if(move_uploaded_file($file['tmp_name'], $target_file)){
                $msg = "<div class='alert alert-success'>Đã up xong ảnh màu <b>$ten_mau</b> cho xe này!<br>File lưu tại: $new_filename</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Lỗi khi lưu file. Kiểm tra quyền ghi thư mục.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-warning'>⚠️ Vui lòng nhập đủ thông tin</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tool Up Ảnh Màu Nhanh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">TOOL UP ẢNH MÀU TỰ ĐỘNG</h4>
            </div>
            <div class="card-body">
                <?php echo $msg; ?>
                
                <form method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label class="fw-bold">1. Chọn xe cần thêm ảnh:</label>
                        <select name="id_sanpham" class="form-select" required>
                            <option value="">-- Chọn xe --</option>
                            <?php
                            // Lấy danh sách xe, sắp xếp mới nhất lên đầu để dễ tìm
                            $sql_sp = "SELECT id_sanpham, tensp, masp, hinhanh FROM tbl_sanpham ORDER BY id_sanpham DESC";
                            $query_sp = mysqli_query($mysqli, $sql_sp);
                            while($row_sp = mysqli_fetch_array($query_sp)){
                                echo '<option value="'.$row_sp['id_sanpham'].'">'.$row_sp['tensp'].' (Mã: '.$row_sp['masp'].') - Ảnh gốc: '.$row_sp['hinhanh'].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">2. Nhập tên màu (Phải giống hệt Admin):</label>
                        <input type="text" name="ten_mau" class="form-control" placeholder="Ví dụ: Trang, Do, Xanh..." required>
                        <small class="text-muted">Lưu ý: Nếu trong Admin ghi là "Trắng" thì ở đây cũng phải gõ "Trắng".</small>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">3. Chọn ảnh xe màu đó (Tên gì cũng được):</label>
                        <input type="file" name="hinhanh_mau" class="form-control" required>
                        <small class="text-muted">Hệ thống sẽ tự động đổi tên file này cho khớp với ảnh gốc.</small>
                    </div>

                    <button type="submit" name="upload_btn" class="btn btn-primary w-100">UPLOAD VÀ TỰ ĐỔI TÊN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>