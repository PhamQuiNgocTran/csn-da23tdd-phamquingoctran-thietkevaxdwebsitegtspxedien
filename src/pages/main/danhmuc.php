<?php
    // 1. Lấy ID Danh mục từ URL
    if(isset($_GET['id'])){
        $id_danhmuc = $_GET['id'];
    } else {
        $id_danhmuc = '';
    }

    // 2. Lấy tên danh mục
    $sql_cate = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$id_danhmuc' LIMIT 1";
    $query_cate = mysqli_query($conn, $sql_cate);
    $row_title = mysqli_fetch_array($query_cate);

    // --- XỬ LÝ BỘ LỌC & SẮP XẾP ---
    $sql_dk_gia = "";     
    $sql_sapxep = "ORDER BY id_sanpham DESC"; 

    // A. Lọc Giá (Dùng +0 để ép kiểu số, tránh lỗi lọc sai)
    if(isset($_GET['mucgia'])){
        $mucgia = $_GET['mucgia'];
        if($mucgia == 'duoi10tr'){
            $sql_dk_gia = " AND (giasp + 0) < 10000000";
        } elseif($mucgia == '10den20tr'){
            $sql_dk_gia = " AND (giasp + 0) BETWEEN 10000000 AND 20000000";
        } elseif($mucgia == 'tren20tr'){
            $sql_dk_gia = " AND (giasp + 0) > 20000000";
        }
    }

    // B. Sắp xếp
    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
        if($sort == 'tang'){
            $sql_sapxep = "ORDER BY (giasp + 0) ASC";
        } elseif($sort == 'giam'){
            $sql_sapxep = "ORDER BY (giasp + 0) DESC";
        } elseif($sort == 'az'){
            $sql_sapxep = "ORDER BY tensp ASC";
        } elseif($sort == 'za'){
            $sql_sapxep = "ORDER BY tensp DESC";
        }
    }

    // C. Truy vấn sản phẩm
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$id_danhmuc' $sql_dk_gia $sql_sapxep";
    $query_pro = mysqli_query($conn, $sql_pro);
?>

<h3 class="text-center fw-bold text-uppercase mb-4 mt-5 py-3" style="color: #000000ff;">
    <?php if($row_title){ echo $row_title['ten_danhmuc']; } else { echo "Sản phẩm"; } ?>
</h3>

<div class="container">

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex flex-wrap justify-content-end align-items-center bg-white p-2 rounded shadow-sm border gap-3">
                
                <div class="d-flex align-items-center">
                    <span class="fw-bold me-2" style="font-size: 0.9rem;"><i class="fas fa-filter text-danger"></i> Lọc giá:</span>
                    <select class="form-select form-select-sm" style="width: 160px;" onchange="location = this.value;">
                        <option value="index.php?quanly=danhmuc&id=<?php echo $id_danhmuc ?>">Tất cả mức giá</option>
                        <option value="index.php?quanly=danhmuc&id=<?php echo $id_danhmuc ?>&mucgia=duoi10tr" <?php if(isset($_GET['mucgia']) && $_GET['mucgia']=='duoi10tr') echo 'selected' ?>>Dưới 10 triệu</option>
                        <option value="index.php?quanly=danhmuc&id=<?php echo $id_danhmuc ?>&mucgia=10den20tr" <?php if(isset($_GET['mucgia']) && $_GET['mucgia']=='10den20tr') echo 'selected' ?>>Từ 10 - 20 triệu</option>
                        <option value="index.php?quanly=danhmuc&id=<?php echo $id_danhmuc ?>&mucgia=tren20tr" <?php if(isset($_GET['mucgia']) && $_GET['mucgia']=='tren20tr') echo 'selected' ?>>Trên 20 triệu</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        if(mysqli_num_rows($query_pro) > 0){
            while($row = mysqli_fetch_array($query_pro)){
        ?>
        
        <div class="col-lg-3 col-md-3 col-6 mb-5">
            <div class="card h-100 shadow-sm border-0">

                <div style="height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img 
                        src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" 
                        alt="<?php echo $row['tensp'] ?>" 
                        style="max-width: 100%; max-height: 100%; object-fit: contain;"
                    >
                </div>

                <div class="d-flex justify-content-center pt-2">
                    <span style="width:10px; height:10px; background:#d90f1d; border-radius:50%; margin:0 3px;"></span>
                    <span style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
                    <span style="width:10px; height:10px; background:#ccc; border-radius:50%; margin:0 3px;"></span>
                </div>

                <div class="card-body d-flex flex-column text-center p-3">
                    <h5 
                        class="fw-bold mb-1 text-uppercase"
                        style="
                            font-size: 1rem; /* Giảm font chữ 1 xíu cho gọn */
                            min-height: 40px; /* Giảm chiều cao tối thiểu xuống xíu */
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            line-height: 1.3; /* Chỉnh dòng khít lại */
                        "
                    >
                        <?php echo $row['tensp'] ?>
                    </h5>

                    <p class="text-danger fw-bold mb-2" style="font-size: 1.1rem;">
                        <?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ' ?>
                    </p>

                    <a 
                        href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>" 
                        class="btn custom-buy-btn mt-auto py-2"
                        style="font-size: 0.8rem;"
                    >
                        CHỌN MUA SẢN PHẤM <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <?php
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-warning text-center">Hiện chưa có sản phẩm nào trong danh mục này.</div></div>';
        }
        ?>
    </div>
</div>