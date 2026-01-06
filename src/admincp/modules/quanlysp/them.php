<p>Thêm sản phẩm mới</p>
<table border="1" width="100%" style="border-collapse: collapse;">
  <form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">
    
    <tr>
      <td>Tên sản phẩm</td>
      <td><input type="text" name="tensanpham" style="width: 100%" required></td>
    </tr>
    
    <tr>
      <td>Mã sản phẩm</td>
      <td><input type="text" name="masp" style="width: 100%" required></td>
    </tr>
    
    <tr>
      <td>Giá sản phẩm</td>
      <td><input type="number" name="giasp" style="width: 100%" required></td>
    </tr>
    
    <tr>
      <td>Số lượng tồn</td>
      <td><input type="number" name="soluong" style="width: 100%" required></td>
    </tr>

    <tr>
      <td>Số lượng bán</td>
      <td><input type="number" name="soluongban" style="width: 100%" value="0"></td>
    </tr>

    <tr>
      <td>Màu sắc</td>
      <td><input type="text" name="mausac" placeholder="Ví dụ: Đỏ, Trắng, Đen" style="width: 100%"></td>
    </tr>
    
    <tr>
      <td>Hình ảnh</td>
      <td><input type="file" name="hinhanh" required></td>
    </tr>
    
    <tr>
      <td>Tóm tắt</td>
      <td><textarea rows="5" name="tomtat" style="resize: none; width: 100%"></textarea></td>
    </tr>
    
    <tr>
      <td>Nội dung</td>
      <td><textarea rows="5" name="noidung" style="resize: none; width: 100%"></textarea></td>
    </tr>
    
    <tr>
      <td>Danh mục sản phẩm</td>
      <td>
        <select name="danhmuc" id="danhmuc" onchange="filterBrands()" style="width: 100%" required>
          <option value="">-- Chọn danh mục --</option>
          <?php
          $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
          $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
          while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
          ?>
          <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
            <?php echo $row_danhmuc['ten_danhmuc'] ?>
          </option>
          <?php } ?>
        </select>
      </td>
    </tr>

    <tr>
      <td>Thương hiệu</td>
      <td>
        <select name="thuonghieu" id="thuonghieu" style="width: 100%" required>
          <option value="">-- Chọn thương hiệu --</option>
          <?php
          $sql_brand = "SELECT * FROM tbl_thuonghieu ORDER BY id_thuonghieu ASC";
          $query_brand = mysqli_query($conn, $sql_brand);
          while($row_brand = mysqli_fetch_array($query_brand)){
          ?>
            <option 
                class="brand-option"
                value="<?php echo $row_brand['id_thuonghieu'] ?>" 
                data-phanloai="<?php echo $row_brand['phanloai'] ?>"
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
        <select name="tinhtrang" style="width: 100%">
          <option value="1">Kích hoạt</option>
          <option value="0">Ẩn</option>
        </select>
      </td>
    </tr>
    
    <tr>
      <td colspan="2"><input type="submit" name="themsanpham" value="Thêm sản phẩm"></td>
    </tr>
    
  </form>
</table>
<script src="js/script.js"></script>