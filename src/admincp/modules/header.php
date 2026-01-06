<ul class="admin_list">
    <li><a href="index.php?action=quanlydanhmuc&query=them">Quản lý danh mục</a></li>
    <li><a href="index.php?action=quanlysanpham&query=them">Quản lý sản phẩm</a></li>
    <li><a href="index.php?action=quanlydonhang&query=lietke">Quản lý đơn hàng</a></li>
    <li><a href="index.php?dangxuat=1" style="color: #ff6b6b;">Đăng xuất : <?php if(isset($_SESSION['dangnhap'])){ echo $_SESSION['dangnhap']; } ?></a></li>
</ul>
