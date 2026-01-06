<?php
    session_start();
    include('config/config.php');

    if(isset($_POST['dangnhap'])){
        $taikhoan = $_POST['username'];
        $matkhau = md5($_POST['password']);
        
        $sql = "SELECT * FROM tbl_admin WHERE username='".$taikhoan."' AND password='".$matkhau."' LIMIT 1";
        $row = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($row);

        if($count > 0){
            $_SESSION['dangnhap'] = $taikhoan;
            header("Location:index.php"); // Đăng nhập đúng -> Vào trang quản trị
        }else{
            // --- SỬA TẠI ĐÂY ---
            // Chỉ hiện thông báo, KHÔNG chuyển hướng nữa
            echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng, vui lòng nhập lại.");</script>'; 
            
            // XÓA DÒNG NÀY ĐI: header("Location:login.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập AdminCP</title>
    <style type="text/css">
        body {
            background: #f3f3f3;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .wrapper-login {
            width: 350px;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 5px;
            text-align: center;
        }
        .wrapper-login h3 {
            margin-bottom: 20px;
            color: #d90f1d;
            text-transform: uppercase;
        }
        table.table-login {
            width: 100%;
        }
        table.table-login tr td {
            padding: 10px 0;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Quan trọng để không vỡ khung */
        }
        input[type="submit"] {
            width: 100%;
            background: #d90f1d;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background: #b50b17;
        }
    </style>
</head>
<body>
    <div class="wrapper-login">
        <h3>Đăng nhập Admin</h3>
        <form action="" autocomplete="off" method="POST">
            <table class="table-login">
                <tr>
                    <td><input type="text" name="username" placeholder="Tài khoản..." required></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Mật khẩu..." required></td>
                </tr>
                <tr>
                    <td><input type="submit" name="dangnhap" value="ĐĂNG NHẬP"></td>
                </tr>
            </table>
        </form>
        <p style="margin-top: 15px; font-size: 13px; color: #888;">Hệ thống quản lý Website Xe Điện</p>
    </div>
</body>
</html>
