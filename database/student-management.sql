-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 11, 2021 lúc 04:28 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `student-management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `account` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adminID`, `account`, `password`) VALUES
(1, 'admin', '$2y$10$9mSh.x6CkRrMSaYpQOtdzOa4bokjTVzRWxpsYzVTbjnFPjfKPLEpG');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `examschedule`
--

CREATE TABLE `examschedule` (
  `esID` int(11) NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `ngayThi` date NOT NULL,
  `gioBatDau` varchar(5) NOT NULL,
  `thoiGianLamBai` int(11) NOT NULL,
  `phongThi` varchar(6) NOT NULL,
  `hocKy` varchar(50) NOT NULL,
  `namHoc` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `examschedule`
--

INSERT INTO `examschedule` (`esID`, `studentID`, `subjectID`, `ngayThi`, `gioBatDau`, `thoiGianLamBai`, `phongThi`, `hocKy`, `namHoc`) VALUES
(4, 'B18DCAT237', 1, '2021-01-06', '08:00', 90, '405-A3', '2', '2020-2021'),
(5, 'B18DCAT237', 2, '2021-01-15', '13:30', 90, '405-A2', '2', '2020-2021'),
(6, 'B18DCAT237', 3, '2021-01-17', '08:00', 90, '303-A3', '2', '2020-2021'),
(7, 'B18DCAT237', 4, '2021-01-18', '10:00', 90, '503-A2', '2', '2020-2021'),
(8, 'B18DCAT237', 5, '2021-01-19', '10:00', 90, '203-A2', '2', '2020-2021'),
(9, 'B18DCAT237', 6, '2021-01-22', '08:00', 90, '301-A2', '2', '2020-2021'),
(10, 'B18DCCN245', 7, '2021-01-06', '08:00', 90, '403-A3', '2', '2020-2021'),
(11, 'B18DCCN245', 8, '2021-01-15', '08:00', 90, '403-A2', '2', '2020-2021'),
(12, 'B18DCCN245', 9, '2021-01-17', '08:00', 90, '305-A3', '2', '2020-2021'),
(13, 'B18DCCN245', 10, '2021-01-18', '10:00', 90, '502-A2', '2', '2020-2021'),
(14, 'B18DCCN245', 11, '2021-01-19', '10:00', 90, '201-A2', '2', '2020-2021'),
(15, 'B18DCCN245', 14, '2021-01-22', '08:00', 90, '305-A2', '2', '2020-2021'),
(17, 'B18DCAT237', 17, '2222-02-22', '08:00', 90, '201-A2', '1', '2020-2021'),
(18, 'B18DCAT237', 18, '1111-11-11', '08:00', 90, '301-A2', '1', '2020-2021'),
(19, 'B18DCAT237', 19, '3333-03-31', '08:00', 90, '301-A2', '1', '2020-2021'),
(20, 'B18DCAT237', 20, '4444-04-04', '08:00', 90, '403-A3', '1', '2020-2021'),
(21, 'B18DCAT237', 21, '5555-05-05', '08:00', 90, '503-A2', '1', '2020-2021'),
(22, 'B18DCAT237', 23, '6666-06-06', '10:00', 120, '601-A3', '1', '2020-2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `studentID` varchar(10) NOT NULL,
  `ten` varchar(150) NOT NULL,
  `lop` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ngaySinh` date NOT NULL,
  `queQuan` varchar(150) NOT NULL,
  `matKhau` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`studentID`, `ten`, `lop`, `email`, `ngaySinh`, `queQuan`, `matKhau`) VALUES
('B18DCAT200', 'nguyễn thanh tùng', 'D18AT02', 'tungnguyen@gmail.com', '2000-05-05', 'Yên Bái', '$2y$10$LNUBlNAfs8mjhDUIoibG2e/GbYMUXHCAFaxIILDuU32Yhltkvenk.'),
('B18DCAT237', 'Vũ Tiến Thành', 'D18AT01', 'armormaster233@gmail.com', '2000-03-23', 'Nam Định', '$2y$10$Me8Ehw2xVdBglq6YvLN27.pJrKuGum26wuDZTqC6udA7R5M1WwDKq'),
('B18DCAT245', 'đoàn văn thìn', 'D18AT02', 'thindoan@gmail.com', '2000-06-12', 'Hà Nội', '$2y$10$.lArISSYM3GIIqs5WwUoMe3KAM3DaSttjLxXdxB1APgLsu1pcuFXW'),
('B18DCCN245', 'Đoàn quang nhân', 'D18CN03', 'nhandoan@gmail.com', '2000-07-13', 'Hà Nội', '$2y$10$baQzPYpyhRPbb5QqryL3gu9JGnb.nG6NMxMm9C0YoFKp1pA/DXkae'),
('B18DCDT148', 'khoa ngọc tiến', 'D18PT02', 'tienkhoa@gmail.com', '2000-01-15', 'Hưng Yên', '$2y$10$k/ceX3Q6doXo7/1LmDxo6OGIireyCcuK0DUlw6OrCzWCIdbBlAOQG'),
('B18DCKT126', 'đỗ văn hà', 'D18KT04', 'habull@gmail.com', '2000-12-12', 'Thanh Hoá', '$2y$10$oT.ZRgmtFJHmk2Qcr6K/sO3dOytQSJ..iq/hUHyNLDcQzhyqpqacC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `subjectID` int(11) NOT NULL,
  `maMon` varchar(7) NOT NULL,
  `tenMon` varchar(100) NOT NULL,
  `soTinChi` int(11) NOT NULL,
  `thu` varchar(8) NOT NULL,
  `ca` int(11) NOT NULL,
  `phong` varchar(6) NOT NULL,
  `giangVien` varchar(150) NOT NULL,
  `hocPhi` int(11) NOT NULL,
  `hocKy` int(2) NOT NULL,
  `namHoc` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`subjectID`, `maMon`, `tenMon`, `soTinChi`, `thu`, `ca`, `phong`, `giangVien`, `hocPhi`, `hocKy`, `namHoc`) VALUES
(1, 'INT1340', 'Nhập môn công nghệ phần mềm', 3, '2', 5, '205-A3', 'H.H.Hạnh', 1440000, 2, '2020-2021'),
(2, 'INT1344', 'Mật mã học cơ sở', 3, '2', 2, '303-A3', 'C.M.Thắng', 1440000, 2, '2020-2021'),
(3, 'INT1434', 'Lập trình Web', 3, '6', 2, '505-A2', 'N.Q.Hưng', 1440000, 2, '2020-2021'),
(4, 'INT1472', 'Cơ sở an toàn thông tin', 3, '3', 2, '503-A2', 'H.X.Dậu', 1440000, 2, '2020-2021'),
(5, 'INT1484', 'An toàn hệ điều hành', 2, '4', 2, '701-A2', 'H.X.Dậu', 1440000, 2, '2020-2021'),
(6, 'INT1487', 'Hệ điều hành Windows và Linux/Unix', 3, '5', 2, '505-A2', 'N.Q.Dũng', 1440000, 2, '2020-2021'),
(7, 'INT1340', 'Nhập môn công nghệ phần mềm', 3, '3', 4, '205-A3', 'H.H.Hạnh', 1440000, 2, '2020-2021'),
(8, 'INT1344', 'Mật mã học cơ sở', 3, '2', 1, '303-A3', 'C.M.Thắng', 1440000, 2, '2020-2021'),
(9, 'INT1434', 'Lập trình Web', 3, '6', 1, '505-A2', 'N.Q.Hưng', 1440000, 2, '2020-2021'),
(10, 'INT1472', 'Cơ sở an toàn thông tin', 3, '3', 1, '503-A2', 'H.X.Dậu', 1440000, 2, '2020-2021'),
(11, 'INT1484', 'An toàn hệ điều hành', 2, '4', 1, '701-A2', 'H.X.Dậu', 1440000, 2, '2020-2021'),
(14, 'INT1487', 'Hệ điều hành Windows và Linux/Unix', 3, '5', 1, '505-A2', 'N.Q.Dũng', 1440000, 2, '2020-2021'),
(17, 'INT1358', 'Toán rời rạc 1', 3, '2', 1, '205-A3', 'C.M.Thắng', 1000000, 1, '2020-2021'),
(18, 'BAS1226', 'Xác suất thống kê', 3, '3', 1, '303-A2', 'H.X.Dậu', 1000000, 1, '2020-2021'),
(19, 'BAS1227', 'Vật lý 3 và thí nghiệm', 3, '4', 1, '403-A2', 'H.X.Dậu', 1000000, 1, '2020-2021'),
(20, 'BAS1122', 'Tư tưởng Hồ Chí Minh', 3, '5', 1, '505-A2', 'H.X.Dậu', 1000000, 1, '2020-2021'),
(21, 'INT1339', 'Ngôn ngữ lập trình C++', 3, '6', 1, '601-A2', 'H.X.Dậu', 1000000, 1, '2020-2021'),
(23, 'INT1323', 'Kiến trúc máy tính', 2, '2', 2, '203-A3', 'N.Q.Dũng', 1000000, 1, '2020-2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transcript`
--

CREATE TABLE `transcript` (
  `transcriptID` int(11) NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `diemCC` float NOT NULL,
  `diemKT` float NOT NULL,
  `diemTH` float DEFAULT NULL,
  `diemBT` float DEFAULT NULL,
  `diemThi` float NOT NULL,
  `diemTK_so` float NOT NULL,
  `diemTK_chu` varchar(3) NOT NULL,
  `ketQua` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `transcript`
--

INSERT INTO `transcript` (`transcriptID`, `studentID`, `subjectID`, `diemCC`, `diemKT`, `diemTH`, `diemBT`, `diemThi`, `diemTK_so`, `diemTK_chu`, `ketQua`) VALUES
(1, 'B18DCAT237', 1, 10, 7, NULL, 6, 7, 7, 'B', 'Đạt'),
(2, 'B18DCAT237', 2, 10, 9, 10, NULL, 4, 6.2, 'C', 'Đạt'),
(3, 'B18DCAT237', 3, 9, 8.5, NULL, 9, 7, 7.6, 'B', 'Đạt'),
(4, 'B18DCAT237', 4, 8, 7, NULL, 6, 6, 6.4, 'C', 'Đạt'),
(5, 'B18DCAT237', 5, 10, 7.5, NULL, 10, 8.5, 8.7, 'A', 'Đạt'),
(7, 'B18DCAT237', 6, 10, 7, 8.5, NULL, 7.5, 7.9, 'B', 'Đạt'),
(8, 'B18DCCN245', 1, 10, 5.5, NULL, 8.5, 6, 6.9, 'C+', 'Đạt'),
(9, 'B18DCCN245', 2, 10, 9, 7, NULL, 7.5, 8, 'B+', 'Đạt'),
(10, 'B18DCCN245', 3, 10, 8, 7, NULL, 7, 7.5, 'B', 'Đạt'),
(11, 'B18DCCN245', 4, 9, 8, NULL, 7, 9.5, 8.8, 'A', 'Đạt'),
(12, 'B18DCCN245', 5, 10, 6, NULL, 7, 6, 6.6, 'C+', 'Đạt'),
(13, 'B18DCCN245', 6, 10, 9, 9, NULL, 7, 7.9, 'B', 'Đạt'),
(16, 'B18DCAT237', 17, 10, 7.5, 10, NULL, 8.5, 8.7, 'A', 'Đạt'),
(17, 'B18DCAT237', 18, 10, 8, 8, NULL, 9, 8.9, 'A', 'Đạt'),
(18, 'B18DCAT237', 19, 10, 7, 8.5, NULL, 7.5, 7.9, 'B', 'Đạt'),
(19, 'B18DCAT237', 20, 9, 8, 7, NULL, 7, 7.4, 'B', 'Đạt'),
(20, 'B18DCAT237', 21, 9, 6.5, 7, NULL, 5, 6.1, 'C', 'Đạt'),
(21, 'B18DCAT237', 23, 10, 7, 6, NULL, 7.5, 7.1, 'B', 'Đạt');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Chỉ mục cho bảng `examschedule`
--
ALTER TABLE `examschedule`
  ADD PRIMARY KEY (`esID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- Chỉ mục cho bảng `transcript`
--
ALTER TABLE `transcript`
  ADD PRIMARY KEY (`transcriptID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `examschedule`
--
ALTER TABLE `examschedule`
  MODIFY `esID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `transcript`
--
ALTER TABLE `transcript`
  MODIFY `transcriptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `examschedule`
--
ALTER TABLE `examschedule`
  ADD CONSTRAINT `FK_studentID_es` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subjectID_es` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `transcript`
--
ALTER TABLE `transcript`
  ADD CONSTRAINT `FK_studentID_transcript` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subjectID` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
