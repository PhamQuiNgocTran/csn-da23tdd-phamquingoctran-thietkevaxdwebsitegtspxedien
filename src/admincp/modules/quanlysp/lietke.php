<?php
    // Kết nối 3 bảng: sanpham, danhmuc, thuonghieu
    $sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc, tbl_thuonghieu 
                      WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                      AND tbl_sanpham.thuonghieu = tbl_thuonghieu.id_thuonghieu 
                      ORDER BY id_sanpham DESC";
    $query_lietke_sp = mysqli_query($conn, $sql_lietke_sp);
?>
<p>Liệt kê danh sách sản phẩm</p>
<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Id</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Giá</th>
    <th>SL Tồn/Bán</th>
    <th>Màu sắc</th>
    <th>Danh mục</th>
    <th>Thương hiệu</th>
    <th>Mã SP</th>
    <th>Trạng thái</th>
    <th>Quản lý</th>
  </tr>
  
  <?php
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_sp)){
    $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    
    <td><?php echo $row['tensp'] ?></td>
    
    <td><img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="100px"></td>
    
    <td><?php echo number_format($row['giasp'],0,',','.').'đ' ?></td>
    
    <td><?php echo $row['soluong'] . ' / ' . $row['soluongban'] ?></td>
    
    <td><?php echo $row['mausac'] ?></td>
    
    <td><?php echo $row['ten_danhmuc'] ?></td>
    
    <td><?php echo $row['ten_thuonghieu'] ?></td>
    
    <td><?php echo $row['masp'] ?></td>
    
    <td><?php echo ($row['tinhtrang']==1) ? 'Kích hoạt' : 'Ẩn'; ?></td>
    
    <td>
        <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>">Xóa</a> | 
        <a href="?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">Sửa</a> 
    </td>
  </tr>
  <?php
  } 
  ?>
</table>