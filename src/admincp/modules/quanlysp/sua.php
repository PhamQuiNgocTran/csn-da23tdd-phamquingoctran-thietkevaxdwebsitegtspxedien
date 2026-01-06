<?php
    $sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
    $query_sua_sp = mysqli_query($conn, $sql_sua_sp);
?>
<p>Sửa sản phẩm</p>
<table border="1" width="100%" style="border-collapse: collapse;">
<?php
while($row = mysqli_fetch_array($query_sua_sp)) {
?>
  <form method="POST" action="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>" enctype="multipart/form-data">
    
    <tr>
      <td>Tên sản phẩm</td>
      <td><input type="text" value="<?php echo $row['tensp'] ?>" name="tensanpham" style="width: 100%"></td>
    </tr>
    
    <tr>
      <td>Mã sản phẩm</td>
      <td><input type="text" value="<?php echo $row['masp'] ?>" name="masp" style="width: 100%"></td>
    </tr>
    
    <tr>
      <td>Giá sản phẩm</td>
      <td><input type="text" value="<?php echo $row['giasp'] ?>" name="giasp" style="width: 100%"></td>
    </tr>
    
    <tr>
      <td>Số lượng tồn</td>
      <td><input type="number" value="<?php echo $row['soluong'] ?>" name="soluong" style="width: 100%"></td>
    </tr>

    <tr>
      <td>Số lượng bán</td>
      <td><input type="number" value="<?php echo $row['soluongban'] ?>" name="soluongban" style="width: 100%"></td>
    </tr>

    <tr>
      <td>Màu sắc</td>
      <td><input type="text" value="<?php echo $row['mausac'] ?>" name="mausac" style="width: 100%"></td>
    </tr>
    
    <tr>
      <td>Hình ảnh</td>
      <td>
        <input type="file" name="hinhanh">
        <br>
        <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
      </td>
    </tr>
    
    <tr>
      <td>Tóm tắt</td>
      <td><textarea rows="5" name="tomtat" style="width: 100%"><?php echo $row['tomtat'] ?></textarea></td>
    </tr>
    
    <tr>
      <td>Nội dung</td>
      <td><textarea rows="5" name="noidung" style="width: 100%"><?php echo $row['noidung'] ?></textarea></td>
    </tr>
    
    <tr>
      <td>Danh mục sản phẩm</td>
      <td>
        <select name="danhmuc" id="danhmuc" onchange="filterBrands()" style="width: 100%">
          <?php
          $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
          $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
          while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
            $selected = ($row_danhmuc['id_danhmuc'] == $row['id_danhmuc']) ? 'selected' : '';
          ?>
            <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>" <?php echo $selected ?>>
                <?php echo $row_danhmuc['ten_danhmuc'] ?>
            </option>
          <?php } ?>
        </select>
      </td>
    </tr>

    <tr>
      <td>Thương hiệu</td>
      <td>
        <select name="thuonghieu" id="thuonghieu" style="width: 100%">
          <?php
          // Dùng GROUP BY để tránh lặp tên thương hiệu
          $sql_brand = "SELECT DISTINCT * FROM tbl_thuonghieu GROUP BY ten_thuonghieu ORDER BY id_thuonghieu DESC";
          $query_brand = mysqli_query($conn, $sql_brand);
          while($row_brand = mysqli_fetch_array($query_brand)){
             $selected = ($row_brand['id_thuonghieu'] == $row['thuonghieu']) ? 'selected' : '';
          ?>
            <option 
                class="brand-option"
                value="<?php echo $row_brand['id_thuonghieu'] ?>" 
                data-phanloai="<?php echo $row_brand['phanloai'] ?>"
                <?php echo $selected ?>
            >
                <?php echo $row_brand['ten_thuonghieu'] ?>
            </option>
          <?php } ?>
        </select>
      </td>
    </tr>
    
    <tr>
      <td>Tình trạng</td>
      <td>
        <select name="tinhtrang">
          <option value="1" <?php if($row['tinhtrang']==1) echo 'selected' ?>>Kích hoạt</option>
          <option value="0" <?php if($row['tinhtrang']==0) echo 'selected' ?>>Ẩn</option>
        </select>
      </td>
    </tr>
    
    <tr>
      <td colspan="2"><input type="submit" name="suasanpham" value="Sửa sản phẩm"></td>
    </tr>
    
  </form>
<?php
} 
?>
</table>

<script src="js/script.js"></script>