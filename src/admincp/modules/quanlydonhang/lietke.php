<p>Liệt kê đơn hàng</p>
<?php
    // Kết nối bảng đơn hàng (tbl_cart) với khách hàng (tbl_dangky)
    $sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_dangky 
                      WHERE tbl_cart.id_dangky = tbl_dangky.id_dangky 
                      ORDER BY tbl_cart.id_cart DESC";
    $query_lietke_dh = mysqli_query($conn, $sql_lietke_dh);
?>
<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Id</th>
    <th>Mã đơn</th>
    <th>Tên khách</th>
    <th>Địa chỉ</th>
    <th>Email / SĐT</th>
    <th>Hình thức ship</th> <th>Tình trạng</th>
    <th>Ngày đặt</th>
    <th>Quản lý</th>
  </tr>
  <?php
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_dh)){
      $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tenkhachhang'] ?></td>
    
    <td>
        <?php echo isset($row['diachi']) ? $row['diachi'] : '<span style="color:red">Chưa cập nhật</span>'; ?>
    </td>
    
    <td>
        <?php echo $row['email'] ?> <br>
        <?php echo $row['dienthoai'] ?>
    </td>
    
    <td>
        <?php echo isset($row['cart_shipping']) ? $row['cart_shipping'] : 'Không rõ'; ?>
    </td>
    
    <td>
        <?php 
        if($row['cart_status']==1){
            echo '<a href="modules/quanlydonhang/xuly.php?code='.$row['code_cart'].'" style="color:red; font-weight:bold;">Đơn mới</a>';
        }else{
            echo '<span style="color:green">Đã xem</span>';
        }
        ?>
    </td>
    <td><?php echo $row['cart_date'] ?></td>
    <td>
        <a href="index.php?action=quanlydonhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem chi tiết</a> 
    </td>
  </tr>
  <?php
  } 
  ?>
</table>