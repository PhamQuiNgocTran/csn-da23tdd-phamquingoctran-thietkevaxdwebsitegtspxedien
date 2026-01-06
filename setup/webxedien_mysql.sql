-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 05, 2026 lúc 07:59 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webxedien_mysql`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `admin_status`) VALUES
(1, 'admin', '05c77ee375c75fbb2bacc395dec4a5ff', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` int(11) NOT NULL,
  `id_dangky` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `cart_status` int(11) DEFAULT 1,
  `cart_date` datetime DEFAULT current_timestamp(),
  `cart_payment` varchar(50) DEFAULT NULL,
  `cart_shipping` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`id_cart`, `id_dangky`, `code_cart`, `cart_status`, `cart_date`, `cart_payment`, `cart_shipping`) VALUES
(23, 6, '4711', 0, '2026-01-01 14:15:44', 'Tiền mặt', 'Giao hàng tiêu chuẩn'),
(24, 7, '5755', 0, '2026-01-03 07:53:02', 'Tiền mặt', 'Giao hàng hỏa tốc'),
(25, 6, '3214', 0, '2026-01-04 09:55:20', 'Tiền mặt', 'Giao hàng tiêu chuẩn'),
(26, 6, '778', 0, '2026-01-05 00:19:29', 'Tiền mặt', 'Giao hàng tiêu chuẩn'),
(27, 6, '3017', 1, '2026-01-05 00:27:42', 'Tiền mặt', 'Giao hàng tiêu chuẩn'),
(28, 6, '4613', 1, '2026-01-05 06:19:20', 'Tiền mặt', 'Giao hàng tiêu chuẩn'),
(29, 6, '5991', 1, '2026-01-05 06:54:54', 'Tiền mặt', 'Giao hàng tiêu chuẩn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart_details`
--

CREATE TABLE `tbl_cart_details` (
  `id_cart_details` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluongmua` int(11) NOT NULL,
  `dongia` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart_details`
--

INSERT INTO `tbl_cart_details` (`id_cart_details`, `id_cart`, `id_sanpham`, `soluongmua`, `dongia`) VALUES
(22, 23, 47, 1, 9200000),
(23, 24, 16, 1, 25990000),
(24, 25, 54, 1, 14490000),
(25, 26, 56, 1, 15990000),
(26, 27, 43, 1, 6500000),
(27, 28, 58, 1, 24900000),
(28, 29, 58, 1, 24900000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_dangky`
--

CREATE TABLE `tbl_dangky` (
  `id_dangky` int(11) NOT NULL,
  `tenkhachhang` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `dienthoai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_dangky`
--

INSERT INTO `tbl_dangky` (`id_dangky`, `tenkhachhang`, `email`, `diachi`, `matkhau`, `dienthoai`) VALUES
(6, 'Bích Ngọc', 'ngtruongtran3@gmail.com', 'Ấp 11, Xã Tân Minh, Huyện Thanh Sơn, Tỉnh Phú Thọ', '96e79218965eb72c92a549dd5a330112', '03989898'),
(7, 'Ngọc Trân', 'tranpham857341@gmail.com', 'Ấp 11, Xã Long Hữu, Thị xã Duyên Hải, Tỉnh Trà Vinh', '96e79218965eb72c92a549dd5a330112', '0392460090');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `ten_danhmuc` varchar(250) NOT NULL,
  `thutu` int(11) DEFAULT 0,
  `trangthai` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`id_danhmuc`, `ten_danhmuc`, `thutu`, `trangthai`) VALUES
(1, 'Xe Máy Điện', 1, 1),
(2, 'Xe Đạp Điện', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `tensp` varchar(250) NOT NULL,
  `masp` varchar(100) NOT NULL,
  `giasp` decimal(12,0) DEFAULT 0,
  `soluong` int(11) DEFAULT 0,
  `soluongban` int(11) DEFAULT 0,
  `hinhanh` varchar(50) DEFAULT NULL,
  `tomtat` text DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `thuonghieu` int(11) DEFAULT NULL,
  `tinhtrang` int(11) DEFAULT 1,
  `mausac` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id_sanpham`, `id_danhmuc`, `tensp`, `masp`, `giasp`, `soluong`, `soluongban`, `hinhanh`, `tomtat`, `noidung`, `thuonghieu`, `tinhtrang`, `mausac`) VALUES
(12, 1, 'VINFAST VEROX', 'A001', 34900000, 5000, 100, '1766990901_vf15.png', '✔ \"Mãnh thú\" đường phố với tốc độ tối đa 70km/h.\r\n✔ Pin LFP công nghệ mới: An toàn, chống cháy nổ tuyệt đối.\r\n✔ Quãng đường khủng: 134km/lần sạc (Nâng cấp tối đa 262km).\r\n✔ Cốp siêu rộng 35 Lít, khóa Smartkey thông minh.', 'THÔNG SỐ KỸ THUẬT CHI TIẾT:\r\n\r\n- Động cơ: Công suất danh định 1500W (Max 2250W) bứt tốc mạnh mẽ.\r\n- Loại Pin: LFP 2.4 kWh (Tuổi thọ cao, sạc ~6.5 tiếng đầy).\r\n- Vận tốc tối đa: 70 km/h (Tăng tốc 0-50km/h dưới 15s).\r\n- Kích thước: 1858 x 690 x 1100 mm (Dài x Rộng x Cao).\r\n- Chiều cao yên: 770 mm (Phù hợp thể trạng người Việt).\r\n- Tiện ích: Cốp 35L (đựng vừa 2 mũ bảo hiểm), Giảm xóc thủy lực, Khóa Smartkey.\r\n- Lốp xe: 90/90-12 (Lốp không săm bám đường tốt).', 1, 1, 'Trắng, Xanh'),
(13, 1, 'VINFAST FLAZZ', 'A002', 16000000, 5000, 100, '1767319055_vf20.png', '✔Chạy 2 Pin: Khác biệt lớn nhất là khả năng lắp thêm pin phụ, giúp đi xa tới 135 km/lần sạc (gấp đôi xe thường).\r\n✔Không cần bằng lái: Tốc độ giới hạn 39 km/h, cực kỳ phù hợp cho học sinh cấp 2, cấp 3.\r\n✔Pin LFP xịn: Dùng công nghệ pin giống các dòng cao cấp (bền, chống cháy nổ tốt), bảo hành pin tới 8 năm.\r\n✔Giá rẻ: Là dòng xe máy điện dùng pin LFP có giá dễ tiếp cận nhất của VinFast hiện nay.', '-Vận hành: Tốc độ tối đa 39 km/h, động cơ 600W (max 1.100W).\r\n-Pin & Quãng đường: Đi được 70 km (1 pin) hoặc 135 km (2 pin), sạc đầy trong 6,5 tiếng.\r\n-Kích thước: Trọng lượng nhẹ 72 kg, lốp không săm 10 inch.\r\n-Tiện ích: Cốp rộng 14 lít (còn 8 lít nếu lắp 2 pin), chống nước IP67, đèn LED và giảm xóc đôi.', 1, 1, 'Đỏ, Đen, Trắng'),
(14, 1, 'VINFAST EVO GRAND', 'A003', 21000000, 5, 100, '1766820039_xevinfast3.png', '✔ Thiết kế Grand sang trọng, kích thước lớn hơn.\r\n✔ Chuyên trị đường trường với pin trâu.\r\n✔ Đèn pha Projector 2 tầng siêu sáng.', '- Động cơ: Inhub 2500W\r\n- Pin: LFP chạy 205km/sạc\r\n- Tốc độ: 70km/h\r\n- Tiện ích: Kết nối App VinFast E-Scooter\r\n- Trọng lượng: 97kg', 1, 1, 'Xanh, Trắng'),
(15, 1, 'VINFAST EVONEO', 'A004', 17800000, 5000, 100, '1766820137_3.jpg', '✔ Nhỏ gọn, thanh lịch cho phái nữ.\r\n✔ Màu sắc trẻ trung, sơn tự nhiên.\r\n✔ Giá thành hợp lý nhất phân khúc pin LFP.', '- Động cơ: 1200W\r\n- Tốc độ: 49km/h (Không cần bằng lái)\r\n- Pin: LFP chạy 150km/sạc\r\n- Cốp: 22 Lít\r\n- Sạc: Tiêu chuẩn 400W', 1, 1, 'Đen, Xanh, Đỏ'),
(16, 1, 'YADEA Oris H', 'B001', 25990000, 5000, 110, '1766820333_yadea1.png', '✔ Thiết kế nam tính, góc cạnh.\r\n✔ Hệ thống đèn LED ma trận.\r\n✔ Chuyên cho các bạn nam cá tính.', '- Động cơ: GTR 3.0 - 2000W\r\n- Ắc quy: Graphene 72V-22Ah\r\n- Phanh: Đĩa đối xứng\r\n- Tốc độ: 60km/h', 2, 1, 'Đen, Nâu'),
(17, 1, 'YADEA Ossy', 'B002', 21990000, 5000, 100, '1766820474_1.jpg', '✔ Thiết kế bo tròn, dễ thương.\r\n✔ Yên thấp, sàn để chân rộng.\r\n✔ Màu pastel ngọt ngào.', '- Động cơ: 1000W êm ái\r\n- Ắc quy: 60V-22Ah\r\n- Tiện ích: Cổng sạc USB, móc treo đồ\r\n- Vận tốc: 45km/h', 2, 1, 'Trắng, Xanh, Đen'),
(18, 1, 'YADEA ODORA S2', 'B003', 15490000, 5000, 100, '1767403452_Anh-ngang-to-1280x880px-copy-2-1.png', '✔ Công nghệ TTFAR vừa đi vừa sạc.\r\n✔ Sơn 5 lớp nhập khẩu Thụy Điển.\r\n✔ Chân chống trợ lực, cốp rộng.', '- Động cơ: TTFAR 1200W\r\n- Ắc quy: Graphene bền gấp 3 lần\r\n- Quãng đường: 100km/sạc\r\n- Khoảng sáng gầm: 150mm', 2, 1, 'Trắng, Xám, Đen'),
(19, 1, 'YADEA Voltguard P-L', 'B004', 27990000, 5000, 100, '1767403087_Anh-sp-chinh-1200x880-xam.png', '✔ Thiết kế \"Vệ binh\" hầm hố.\r\n✔ Bánh xe 14 inch vượt địa hình tốt.\r\n✔ Sàn để chân dài 30cm.', '- Động cơ: 1500W (Max 2800W)\r\n- Tốc độ: 55km/h\r\n- Ắc quy: 72V-38Ah (Dung lượng khủng)\r\n- Phanh: CBS an toàn', 2, 1, 'Xám, Đen, Trắng'),
(20, 1, 'DIBAO LS007', 'C001', 23490000, 5000, 100, '1766821450_dibao1.png', '✔ Kiểu dáng hộp vuông hiện đại.\r\n✔ Đèn Led ngang sang trọng.\r\n✔ Yên xe phân tầng thể thao.', '- Động cơ: 1500W nhập khẩu\r\n- Phanh: 2 Phanh đĩa piston\r\n- Tốc độ: 55km/h\r\n- Lốp: 90/90-10', 3, 1, 'Đen, Trắng, Ghi'),
(23, 1, 'DIBAO GOGO S4', 'C004', 18590000, 5000, 100, '1766822213_dibao4.png', '✔ Thiết kế bo tròn từ tương lai.\r\n✔ Dải led kéo dài ngang đầu xe.\r\n✔ Cốp siêu rộng, sàn để chân rộng nhất.', '- Động cơ: Siêu chống nước 1500W\r\n- Tốc độ: Có thể đạt 60km/h\r\n- Phanh: 2 đĩa\r\n- Tiện ích: Cổng sạc điện thoại', 3, 1, 'Cam, Vàng, Xanh'),
(24, 1, 'VINFAST KLARA NEO', 'A005', 28800000, 5000, 100, '1766990796_vf14.jpg', '✔ Thiết kế Italian kinh điển, không lỗi mốt.\r\n✔ Khung gầm chắc chắn, đầm xe.\r\n✔ Màn hình kết nối thông minh 4.0.', '- Động cơ: Bosch (Đức) 1200W\r\n- Pin: Lithium-ion cao cấp\r\n- Phanh: Đĩa Nissin cả 2 bánh\r\n- Tốc độ: 50km/h\r\n- Tiện ích: 3G, GPS, Bluetooth', 1, 1, 'Trắng, Đỏ'),
(25, 2, 'YADEA X-SKY', 'D001', 11990000, 5000500, 100, '1766925204_ye.1.png', '✔ Khung lộ thiên thể thao.\r\n✔ Dành cho học sinh cấp 2.', '- Động cơ: 500W\r\n- Pin: 4 bình 12Ah', 2, 1, 'Xanh, Trắng , Xanh Bơ'),
(27, 2, 'YADEA XBULL 2024', 'D003', 14900000, 5000, 100, '1766925474_ye3.png', '✔ Dòng bò điên huyền thoại 2024.\r\n✔ Khỏe khoắn, bền bỉ.', '- Động cơ: TTFAR 600W\r\n- Lốp: Không săm', 2, 1, 'Đen Đỏ, Đen Vàng'),
(28, 2, 'YADEA VEKOO', 'D004', 14990000, 5000, 100, '1766925554_ye4.png', '✔ Xe đạp điện cơ bản.', '- Động cơ: 350W', 2, 1, 'Đỏ, Xanh Lá, Đen'),
(29, 2, 'YADEA iFUN', 'D005', 11900000, 5000, 100, '1766925742_ye5.png', '✔ Xe đạp điện cơ bản.', '- Động cơ: 350W', 2, 1, 'Trắng, Xanh'),
(30, 2, 'YADEA i6', 'D006', 11790000, 5000, 100, '1766925783_ye6.png', '✔ Xe đạp điện cơ bản.', '- Động cơ: 350W', 2, 1, 'Hồng, Xanh Dương'),
(31, 2, 'YADEA iGo', 'D007', 12990000, 5000, 100, '1766925826_ye7.png', '✔ Xe đạp điện cơ bản.', '- Động cơ: 350W', 2, 1, 'Tím, Đen'),
(32, 2, 'YADEA i8', 'D008', 13990000, 500, 100, '1766925876_ye8.png', '✔ Xe đạp điện cơ bản.', '- Động cơ: 350W', 2, 1, 'Trắng, Xanh Dương, Xanh Lá'),
(33, 2, 'TAILG GR56', 'E001', 14500000, 5000, 120, '1766927506_tl1.png', '✔ Xe điện Tailg nội địa.\r\n✔ Bền bỉ nồi đồng cối đá.', '- Động cơ: 800W\r\n- Khóa: Smartkey', 5, 1, 'Xanh Bơ, Đen, Trắng'),
(34, 2, 'TAILG GR55', 'E002', 12990000, 5000, 110, '1766927806_tl2.png', '✔ Dòng Tailg phổ thông.', '- Động cơ: 600W', 5, 1, 'Hồng, Đen, Nâu'),
(35, 2, 'Tailg X51', 'E003', 15600000, 5000, 100, '1766927968_tl3.png', '✔ Dòng Tailg phổ thông.', '- Động cơ: 600W', 5, 1, 'Xanh Bơ, Trắng, Xanh'),
(36, 2, 'TAILG JY32', 'E004', 50000000, 1000, 70, '1766928044_tl4.png', '✔ Phiên bản giới hạn nhập khẩu.\r\n✔ Công nghệ pin Lithium cao cấp.', '- Động cơ: 3000W\r\n- Pin: Lithium 72V\r\n- Tốc độ: 80km/h', 5, 1, 'Cam'),
(37, 2, 'TAILG JY34', 'E005', 11900000, 5000, 100, '1766928085_tl5.png', '✔ Dòng Tailg phổ thông.', '- Động cơ: 600W', 5, 1, 'Nâu, Đen'),
(38, 2, 'TAILG JS50', 'E006', 15400000, 5000, 105, '1766928132_tl6.png', '✔ Dòng Tailg phổ thông.', '- Động cơ: 600W', 5, 1, 'Nâu, Hồng'),
(39, 2, 'TAILG Wukong GT50', 'E007', 15400000, 5000, 100, '1766928212_tl7.png', '✔ Dòng Tailg phổ thông.', '- Động cơ: 600W', 5, 1, 'Đỏ, Cam, Xanh'),
(40, 2, 'Tailg JY33', 'E008', 10500000, 5000, 100, '1766928278_tl8.png', '✔ Dòng Tailg phổ thông.', '- Động cơ: 600W', 5, 1, 'Xanh, Hồng, Nâu'),
(41, 2, 'E8', 'F001', 6900000, 5000, 100, '1766929247_m1.png', '✔ Mẫu E8 cơ bản giá rẻ.', '- Động cơ: 350W\r\n- Vành đúc', 6, 1, 'Hồng, Xanh'),
(42, 2, 'SK8', 'F001', 6900000, 5000, 100, '1766929301_e2.png', '✔ Xe đạp điện 2 yên.', '- Động cơ: 400W', 6, 1, 'Ghi, Đen, Trắng'),
(43, 2, 'E2', 'F003', 6500000, 5000, 106, '1766929336_m3.png', '✔ Xe đạp điện 2 yên.', '- Động cơ: 400W', 6, 1, 'Vàng, Nâu, Xanh'),
(44, 2, 'E4', 'F004', 6500000, 5000, 100, '1766929358_m4.png', '✔ Xe đạp điện 2 yên.', '- Động cơ: 400W', 6, 1, 'Xanh'),
(45, 2, 'POKEMON', 'F005', 7500000, 5000, 100, '1766929388_m5.png', '✔ Tem xe Pokemon ngộ nghĩnh.', '- Động cơ: 350W\r\n- Có bàn đạp trợ lực', 6, 1, 'Xanh '),
(46, 2, 'E6', 'F006', 7500000, 5000, 100, '1766929456_m7.png', '✔ Xe đạp điện 2 yên.', '- Động cơ: 400W', 6, 1, 'Xanh, Ghi'),
(47, 2, 'E6 PRO', 'F007', 9200000, 5000, 100, '1766929533_m8.png', '✔ Xe đạp điện 2 yên.', '- Động cơ: 400W', 6, 1, 'Đen, Đỏ, Trắng'),
(48, 2, 'SPORT', 'F008', 10900000, 5, 100, '1766929575_M6.png', '✔ Kiểu dáng Sport năng động.', '- Động cơ: 500W\r\n- Giảm xóc dầu', 6, 1, 'Tím, Đen, Xanh'),
(49, 1, 'DIBAO CREER NILE', 'C005', 17690000, 5000, 100, '1766929837_db5.jpg', '✔ Dòng Creer cổ điển (Cub).\r\n✔ Đèn Halogen tròn.', '- Động cơ: 1000W\r\n- Tốc độ: 50km/h', 3, 1, 'Xanh Bơ, Xanh Lá, Xanh Dương'),
(50, 1, 'DIBAO TESLA CHIC ĐÈN VUÔNG', 'C006', 17500000, 5000, 100, '1766929932_db6.jpg', '✔ Đèn vuông cá tính.', '- Động cơ: 1400W\r\n- Phanh đĩa trước', 3, 1, 'Xanh, Đen, Trắng'),
(51, 1, 'DIBAO CREER E', 'C007', 12900000, 5000, 100, '1766930042_db7.jpg', '✔ Bản tiết kiệm điện.', '- Động cơ: 800W\r\n- Pin: 48V-20Ah', 3, 1, 'Kem Sữa, Vàng, Cam'),
(52, 1, 'DIBAO PANSY DIO ĐỜI MỚI', 'C008', 18690000, 5000, 100, '1766930293_db8.jpg', '✔ Pansy đời mới nâng cấp đèn.', '- Động cơ: 1500W\r\n- Sơn: Phủ Nano', 3, 1, 'Đỏ, Xanh Dương'),
(53, 1, 'YADEA ORLA P', 'B005', 20490000, 5000, 100, '1766969247_yd5.png', '✔ Mang hơi hướng cổ điển châu Âu.\r\n✔ Đèn pha hình logo Yadea độc đáo.\r\n✔ Phù hợp phái đẹp văn phòng.', '- Động cơ: 800W\r\n- Ắc quy: 60V-26Ah\r\n- Quãng đường: 80km\r\n- Chiều cao yên: 750mm', 2, 1, 'Xanh Lục, Đỏ, Tím'),
(54, 1, 'YADEA iCute', 'B006', 14490000, 5000, 150, '1766969326_yd6.png', '✔ Thiết kế lấy cảm hứng từ mèo máy.\r\n✔ Nhỏ gọn, dễ luồn lách ngõ nhỏ.\r\n✔ Tem xe hoạt hình đáng yêu.', '- Động cơ: 400W\r\n- Ắc quy: 48V-12Ah Lithium\r\n- Trọng lượng: 40kg\r\n- Tốc độ: 30km/h', 2, 1, 'Trắng, Xanh, Hồng'),
(55, 1, 'YADEA ODORA S', 'B007', 16500000, 5000, 130, '1766969395_yd7.png', '✔ Phiên bản tiêu chuẩn.\r\n✔ Bền bỉ, tiết kiệm.', '- Động cơ: 1000W\r\n- Ắc quy: 60V-20Ah', 2, 1, 'Trắng, Tím, Xanh'),
(56, 1, 'YADEA VIGOR', 'B008', 15990000, 5000, 100, '1766969464_yd8.png', '✔ Phiên bản tiêu chuẩn.\r\n✔ Bền bỉ, tiết kiệm.', '- Động cơ: 1000W\r\n- Ắc quy: 60V-20Ah', 2, 1, 'Đen, Xám, Đỏ'),
(57, 1, 'VINFAST VENTO NEO', 'A006', 32000000, 5000, 100, '1766990608_vf13.jpg', '✔ Dòng xe cao cấp nhất.\r\n✔ Phanh ABS an toàn chống trượt.\r\n✔ Động cơ đặt bên (Side Motor) cực mạnh.', '- Động cơ: Side Motor 4000W\r\n- Tốc độ: 80km/h\r\n- Pin: 2 Pin LFP song song\r\n- Công nghệ: PAAK (Phone As A Key)\r\n- Phanh: ABS Continental', 1, 1, 'Vàng, Xanh, Đen'),
(58, 1, 'VINFAST FELIZ', 'A007', 24900000, 5000, 100, '1766971035_vf11.png', '✔ Mẫu xe quốc dân, bền bỉ.\r\n✔ Gầm cao máy thoáng, leo lề tốt.\r\n✔ Hệ thống giảm xóc Showa êm ái.', '- Động cơ: 1200W\r\n- Ắc quy: Ắc quy chì axit bền bỉ\r\n- Tốc độ: 60km/h\r\n- Quãng đường: 90km/sạc', 1, 1, 'Đen, Xanh '),
(59, 1, 'VINFAST EVO200 LITE', 'A008', 22000000, 5000, 122, '1766990082_vf12.png', '✔ Giới hạn tốc độ an toàn cho học sinh.\r\n✔ Không cần bằng lái.\r\n✔ Pin LFP đi xa nhất phân khúc.', '- Tốc độ giới hạn: 49km/h\r\n- Pin: LFP 1 quãng đường 205km\r\n- Động cơ: Inhub 1200W\r\n- Trọng lượng: 97kg (cả pin)', 1, 1, 'Đỏ, Đen , Xanh'),
(64, 2, 'YADEA I3', 'D009', 14000000, 500, 90, '1767365879_Xe-dap-dien-Yadea-i3-2021-2048x2048.jpg', 'Pin Lithium cao cấp: Trọng lượng siêu nhẹ, có thể tháo rời mang vào nhà sạc dễ dàng (khác biệt lớn nhất với các xe ắc quy như I8, X-Bull).\r\nThiết kế: Vuông vắn, hiện đại, 2 yên tách rời (người ngồi sau thoải mái hơn).\r\nCông nghệ: Chìa khóa thông minh (Smartkey) chống trộm, màn hình LCD sắc nét.', 'Vận tốc tối đa: 30 km/h.\r\n\r\nQuãng đường: Khoảng 50 km / 1 lần sạc.\r\n\r\nPin: Lithium 48V - 12Ah.\r\n\r\nTrọng lượng xe: Rất nhẹ, chỉ khoảng 40kg (dễ dắt xe).\r\n\r\nGiá tham khảo: ~13.990.000 VNĐ.', 2, 1, 'Vàng, Trắng'),
(65, 1, 'DIBAO JEEK ONE', 'D002', 20690000, 500, 100, '1767405280_xe-may-dien-dibao-jeek-one-31.jpg', '✔ Đầu xe \"Chiến binh\": Thiết kế đầu xe cực ngầu với 4 bi cầu LED siêu sáng, nhìn như robot.\r\n✔ 2 Phanh đĩa: Trang bị phanh đĩa cho cả bánh trước và bánh sau (Xman chỉ có đĩa trước), an toàn hơn hẳn khi phanh gấp.\r\n✔ Vành đúc chữ Y: Bộ vành (mâm) thiết kế chữ Y thể thao, chịu lực tốt.', '- Động cơ: 1.500W (Max 1.600W - Bứt tốc cực nhanh).\r\n- Vận tốc: ~50 - 55 km/h.\r\n- Quãng đường: 60 - 90 km/lần sạc (tùy tải trọng).\r\n- Phanh: 2 Phanh đĩa (Trước & Sau).\r\n- Ắc quy: 60V - 20Ah (5 bình lớn).', 3, 1, 'Cam, Xanh, Đen'),
(66, 1, 'DIBAO XMAN NEO', 'D006', 15200000, 500, 100, '1767405550_1679905040_xman-neo-db.jpg', '✔ Thiết kế chữ X: Mặt nạ trước chữ X đặc trưng, nhìn khỏe khoắn, gọn gàng, không quá hầm hố.\r\n✔ Đèn LED: Hệ thống đèn pha LED siêu sáng và đèn định vị ban ngày hiện đại.\r\n✔ Giảm xóc giữa: Sử dụng phuộc đơn (monoshock) ở giữa giúp xe cân bằng tốt khi vào cua.', '- Động cơ: 1.450W (Mạnh mẽ, leo dốc hầm xe tốt).\r\n- Vận tốc: ~50 - 55 km/h.\r\n- Quãng đường: 70 - 80 km/lần sạc.\r\n- Phanh: Phanh đĩa trước, phanh cơ sau.\r\n- Ắc quy: 60V - 20Ah (5 bình lớn).', 3, 1, 'Xanh, Đen, Nâu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thuonghieu`
--

CREATE TABLE `tbl_thuonghieu` (
  `id_thuonghieu` int(11) NOT NULL,
  `ten_thuonghieu` varchar(100) NOT NULL,
  `phanloai` tinyint(1) DEFAULT 0 COMMENT '0:All, 1:XeMay, 2:XeDap',
  `thutu` int(11) DEFAULT 1,
  `trangthai` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_thuonghieu`
--

INSERT INTO `tbl_thuonghieu` (`id_thuonghieu`, `ten_thuonghieu`, `phanloai`, `thutu`, `trangthai`) VALUES
(1, 'VinFast', 1, 1, 1),
(2, 'Yadea', 0, 2, 1),
(3, 'Dibao', 1, 3, 1),
(5, 'Tailg', 2, 5, 1),
(6, 'Move', 2, 6, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `fk_cart_khachhang` (`id_dangky`);

--
-- Chỉ mục cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  ADD PRIMARY KEY (`id_cart_details`),
  ADD KEY `fk_details_cart` (`id_cart`),
  ADD KEY `fk_details_sanpham` (`id_sanpham`);

--
-- Chỉ mục cho bảng `tbl_dangky`
--
ALTER TABLE `tbl_dangky`
  ADD PRIMARY KEY (`id_dangky`);

--
-- Chỉ mục cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id_sanpham`),
  ADD KEY `fk_sanpham_danhmuc` (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_thuonghieu`
--
ALTER TABLE `tbl_thuonghieu`
  ADD PRIMARY KEY (`id_thuonghieu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  MODIFY `id_cart_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `tbl_dangky`
--
ALTER TABLE `tbl_dangky`
  MODIFY `id_dangky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `tbl_thuonghieu`
--
ALTER TABLE `tbl_thuonghieu`
  MODIFY `id_thuonghieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_cart_khachhang` FOREIGN KEY (`id_dangky`) REFERENCES `tbl_dangky` (`id_dangky`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  ADD CONSTRAINT `fk_details_cart` FOREIGN KEY (`id_cart`) REFERENCES `tbl_cart` (`id_cart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_details_sanpham` FOREIGN KEY (`id_sanpham`) REFERENCES `tbl_sanpham` (`id_sanpham`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`id_danhmuc`) REFERENCES `tbl_danhmuc` (`id_danhmuc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
