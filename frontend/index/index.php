<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["userID"])) {
    session_destroy();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="../assets/img/favicon/favicon.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- Start navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a href="#" class="navbar-brand mx-3">
            <img src="../assets/img/ptit-logo/ptit-logo.png" alt="Logo" class="ptit-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId">
            <i class="fas fa-align-justify"></i>
        </button>
        <div class="collapse navbar-collapse " id="collapsibleNavId">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#">Trang chủ</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#subject-register">Đăng ký môn học</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#tuition">Học phí</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#timetable">Thời khoá biểu</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#test-schedule">Lịch thi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#score">Điểm</a>
                </li>
                <!-- <li class="nav-item">
                    <div class="student-info my-2 ml-lg-5  text-center">
                        Vũ Tiến Thành - B18DCAT237
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="#personal-info">TT Cá Nhân</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 text-center text-light" href="../user_logout/user_logout.php">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start carousel -->
    <div class="container-fluid slider">
        <div id="carouselId" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
                <li data-target="#carouselId" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/img/sliders/slider1.png" alt="First slide" style="width: 100%">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/sliders/slider2.png" alt="Second slide" style="width: 100%">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/sliders/slider3.png" alt="Third slide" style="width: 100%">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/sliders/slider4.png" alt="Fourth slide" style="width: 100%">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- End carousel -->

    <!-- Start subject register -->
    <!-- <div class="container-fluid subject-register" id="subject-register">
        <div class="subject-register__title mb-4 mt-3">
            <h2 class="text-center">ĐĂNG KÝ MÔN HỌC</h2>
        </div>

        <form class="form-inline subject-search ml-5">
            <div class="form-group">
                <label class="mr-3 mb-1" for="">Nhập tên môn hoặc mã môn</label>
                <input class="mr-3 subject-search__textfield" type="text" id="subject-id" class="form-control">
            </div>
            <button type="button" class="btn btn-success search-btn">Tìm kiếm</button>
        </form>

        <div class="form-inline mx-5 mt-3 mb-5">
            <label class="subject-choice-label my-3 mr-3">Danh sách các môn kì này</label>
            <select class="form-control subject-item subject-register__list w-50 ml-3" name="" id="">
                <option>INT1484 - An toàn hệ điều hành</option>
                <option>INT1340 - Nhập môn công nghệ phần mềm</option>
                <option>INT1344 - Mật mã học cơ sở</option>
                <option>INT1434 - Lập trình Web</option>
                <option>INT1472 - Cơ sở an toàn thông tin</option>
                <option>INT1487 - Hệ điều hành Windows và Linux/Unix</option>
            </select>
        </div>

        <div class="table-responsive-lg subject-table px-48">
            <table class="table table-bordered text-center table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Mã Môn</th>
                        <th>Tên Môn</th>
                        <th>Số Tín Chỉ</th>
                        <th>Thứ</th>
                        <th>Tiết</th>
                        <th>Phòng</th>
                        <th>Giảng Viên</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                        <td>INT1484</td>
                        <td> An toàn hệ điều hành </td>
                        <td>2</td>
                        <td>4</td>
                        <td>2</td>
                        <td>701-A2</td>
                        <td>H.X.Dậu</td>

                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                        <td>INT1484</td>
                        <td> An toàn hệ điều hành </td>
                        <td>2</td>
                        <td>6</td>
                        <td>3</td>
                        <td>101-A2</td>
                        <td>H.X.Dậu</td>

                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                        <td>INT1484</td>
                        <td> An toàn hệ điều hành </td>
                        <td>2</td>
                        <td>2</td>
                        <td>1</td>
                        <td>206-A2</td>
                        <td>H.X.Dậu</td>

                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                        <td>INT1484</td>
                        <td> An toàn hệ điều hành </td>
                        <td>2</td>
                        <td>5</td>
                        <td>2</td>
                        <td>501-A2</td>
                        <td>H.X.Dậu</td>

                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                        <td>INT1484</td>
                        <td> An toàn hệ điều hành </td>
                        <td>2</td>
                        <td>4</td>
                        <td>2</td>
                        <td>301-A3</td>
                        <td>H.X.Dậu</td>

                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                        <td>INT1484</td>
                        <td> An toàn hệ điều hành </td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>701-A3</td>
                        <td>H.X.Dậu</td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="subject-result">
            <h4 class="ml-5 mt-5 mb-4">Kết quả đăng ký</h4>
        </div>

        <div class="table-responsive-lg subject-result-table px-48">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Môn</th>
                        <th>Tên Môn</th>
                        <th>Số Tín Chỉ</th>
                        <th>Trạng Thái Môn Học</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>INT1484</td>
                        <td>An toàn hệ điều hành</td>
                        <td>2</td>
                        <td>Đã Lưu</td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>INT1472</td>
                        <td>Cơ sở an toàn thông tin</td>
                        <td>3</td>
                        <td>Đã Lưu</td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>INT1344</td>
                        <td>Mật mã học cơ sở</td>
                        <td>3</td>
                        <td>Đã Lưu</td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>INT1340</td>
                        <td>Nhập môn công nghệ phần mềm</td>
                        <td>3</td>
                        <td>Đã Lưu</td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>INT1487</td>
                        <td> Hệ điều hành Windows và Linux/Unix </td>
                        <td>3</td>
                        <td>Đã Lưu</td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>INT1434</td>
                        <td>Lập trình Web</td>
                        <td>3</td>
                        <td>Đã Lưu</td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="clearfix my-4">
            <button type="button" class="btn btn-primary float-right mr-5 ml-3 save-btn">Lưu Đăng Ký</button>
            <button type="button" class="btn btn-danger float-right erase-btn">Xoá</button>
        </div>

    </div> -->
    <!-- End subject register -->

    <!-- Start tuition -->
    <div class="container-fluid tuition-section" id="tuition">
        <div class="tuition-title">
            <h2 class="text-center">HỌC PHÍ</h2>
        </div>

        <?php
        $sql = "select subject.*
        from ((examschedule
        inner join subject on examschedule.subjectID = subject.subjectID)
        inner join student on examschedule.studentID = student.studentID)
        where student.studentID='{$_SESSION["userID"]}' and subject.namHoc='2020-2021'
        and subject.hocKy='2' order by subject.subjectID";

        $esList = executeResult($sql);
        if (count($esList) !== 0)
            foreach ($esList as $std) {
                echo "
                <div class='tuition-semester'>
                    <h4 class='ml-5 mt-3 mb-4'>Học kỳ {$std['hocKy']} - Năm học {$std['namHoc']}</h4>
                </div>";
                break;
            }
        ?>

        <!-- <div class="tuition-semester">
            <h4 class="ml-5 mt-3 mb-4">Học kỳ 2 - Năm học 2020-2021</h4>
        </div> -->

        <div class="table-responsive-lg tuition-table text-center px-48">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Môn</th>
                        <th>Tên Môn</th>
                        <th>Số Tín Chỉ</th>
                        <th>Học Phí</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $index = 1;
                    if (count($esList) !== 0)
                        foreach ($esList as $std) {
                            echo "<tr>
                            <td>" . ($index++) . "</td>
                            <td>{$std["maMon"]}</td>
                            <td>{$std["tenMon"]}</td>
                            <td>{$std["soTinChi"]}</td>
                            <td>{$std["hocPhi"]}</td>
                        </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex tuition-current ml-5 my-4">
            <div class="mr-4">
                <b>Tổng học phí:</b> <br>
                <b>Số tiền đã đóng:</b> <br>
                <b>Số tiền còn nợ:</b>
            </div>

            <div>
                <?php
                if (count($esList) !== 0) {
                    $sum = 0;
                    foreach ($esList as $std) {
                        $sum += $std["hocPhi"];
                    }
                    echo "
                    <b>{$sum} VND</b> <br>
                    <b>0 VND</b> <br>
                    <b>{$sum} VND</b>";
                }

                ?>
            </div>
        </div>
    </div>
    <!-- End tuition -->

    <!-- Start timetable -->
    <!-- <div class="container-fluid timetable-section text-center" id="timetable">
        <div class="timetable-title">
            <h2 class="text-center">THỜI KHOÁ BIỂU</h2>
        </div>

        <div class="form-group form-inline ml-5">
            <label for="" class="mr-3">Học kỳ</label>
            <select class="form-control ml-4" name="" id="">
                <option>Học kỳ 1 - Năm học 2020-2021</option>
                <option>Học kỳ 2 - Năm học 2020-2021</option>
            </select>
        </div>

        <div class="form-group form-inline ml-5 mt-3">
            <label for="">Tuần học</label>
            <select class="form-control ml-4" name="" id="">
                <option>Tuần 25 [Từ 22/02/2021 -- Đến 28/02/2021]</option>
                <option>Tuần 26 [Từ 01/03/2021 -- Đến 07/03/2021]</option>
                <option>Tuần 27 [Từ 08/03/2021 -- Đến 14/03/2021]</option>
                <option>Tuần 28 [Từ 15/03/2021 -- Đến 21/03/2021]</option>
                <option>Tuần 29 [Từ 22/03/2021 -- Đến 28/03/2021]</option>
                <option>Tuần 30 [Từ 29/03/2021 -- Đến 04/04/2021]</option>
                <option>Tuần 31 [Từ 05/04/2021 -- Đến 11/04/2021]</option>
                <option>Tuần 32 [Từ 12/04/2021 -- Đến 18/04/2021]</option>
                <option>Tuần 33 [Từ 19/04/2021 -- Đến 25/04/2021]</option>
                <option>Tuần 34 [Từ 26/04/2021 -- Đến 02/05/2021]</option>
                <option>Tuần 35 [Từ 03/05/2021 -- Đến 09/05/2021]</option>
                <option>Tuần 36 [Từ 10/05/2021 -- Đến 16/05/2021]</option>
                <option>Tuần 37 [Từ 17/05/2021 -- Đến 23/05/2021]</option>
                <option>Tuần 38 [Từ 24/05/2021 -- Đến 30/05/2021]</option>
                <option>Tuần 39 [Từ 31/05/2021 -- Đến 06/06/2021]</option>
                <option>Tuần 40 [Từ 07/06/2021 -- Đến 13/06/2021]</option>
            </select>
        </div>

        <div class="table-responsive-lg timetable-table mt-5">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>KÍP</th>
                        <th>THỨ 2</th>
                        <th>THỨ 3</th>
                        <th>THỨ 4</th>
                        <th>THỨ 5</th>
                        <th>THỨ 6</th>
                        <th>THỨ 7</th>
                        <th>CHỦ NHẬT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td>
                            Mật mã học cơ sở <br>
                            Phòng: <b>303-A3</b>
                        </td>
                        <td>
                            <div>Cơ sở an toàn thông tin</div>
                            <div>Phòng: <b>503-A2</b></div>
                        </td>
                        <td>
                            <div>An toàn hệ điều hành</div>
                            <div>Phòng: <b>701-A2</b></div>
                        </td>
                        <td>
                            <div>Hệ điều hành Windows và Linux/Unix</div>
                            <div>Phòng: <b>703-A2</b></div>
                        </td>
                        <td>
                            <div>Lập trình Web</div>
                            <div>Phòng: <b>505-A2</b></div>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td scope="row">3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row">4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row">5</td>
                        <td></td>
                        <td>
                            <div>Nhập môn công nghệ phần mềm</div>
                            <div>Phòng: <b>205-A3</b></div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row">6</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="button-direction mt-4">
            <button type="button" class="btn btn-primary mr-1">Tuần đầu</button>
            <button type="button" class="btn btn-primary mr-1">Tuần trước</button>
            <button type="button" class="btn btn-primary mr-1">Tuần tới</button>
            <button type="button" class="btn btn-primary">Tuần cuối</button>
        </div>
    </div> -->
    <!-- End timetable -->

    <!-- Start test-schedule -->
    <div class="container-fluid test-schedule-section" id="test-schedule">
        <div class="test-schedule__title">
            <h2 class="text-center">LỊCH THI</h2>
        </div>

        <form method="post" class="form-group form-inline ml-5">
            <label for="" class="mr-3">Học kỳ</label>
            <select class="form-control ml-2" name="hocKy" id="hocKy">
                <option value="1_2020-2021">Học kỳ 1 - Năm học 2020-2021</option>
                <option value="2_2020-2021">Học kỳ 2 - Năm học 2020-2021</option>
            </select>
        </form>

        <div class="table-responsive-lg test-schedule__table mt-5 px-48 text-center">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Môn</th>
                        <th>Tên Môn</th>
                        <th>Ngày Thi</th>
                        <th>Giờ bắt đầu</th>
                        <th>Thời gian làm bài</th>
                        <th>Phòng Thi</th>
                    </tr>
                </thead>
                <tbody class="lichThi">
                    <?php
                    
                        $sql = "select examschedule.*, subject.*
                        from ((examschedule
                        inner join subject on examschedule.subjectID = subject.subjectID)
                        inner join student on examschedule.studentID = student.studentID)
                        where student.studentID='{$_SESSION['userID']}'and subject.namHoc='2020-2021'
                        and subject.hocKy='1' order by examschedule.esID";

                        $index = 1;
                        $esList = executeResult($sql);
                        if (count($esList) !== 0)
                            foreach ($esList as $std) {
                                $date = date_create($std["ngayThi"]);
                                $date = date_format($date, "d/m/Y");
                                echo "<tr>
                                        <td>" . ($index++) . "</td>
                                        <td>{$std["maMon"]}</td>
                                        <td>{$std["tenMon"]}</td>
                                        <td>{$date}</td>
                                        <td>{$std["gioBatDau"]}</td>
                                        <td>{$std["thoiGianLamBai"]}</td>
                                        <td>{$std["phongThi"]}</td>
                                    </tr>";
                            }
                    
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- End test-schedule -->

    <!-- start score -->
    <div class="container-fluid score-section" id="score">
        <div class="score-title">
            <h2 class="text-center">ĐIỂM</h2>
        </div>

        <form class="form-group form-inline">
            <label for="" class="mr-3">Học kỳ</label>
            <select class="form-control ml-2" name="hocKy1" id="hocKy1">
                <option value="1_2020-2021">Học kỳ 1 - Năm học 2020-2021</option>
                <option value="2_2020-2021">Học kỳ 2 - Năm học 2020-2021</option>
            </select>
            
        </form>


        <div class="table-responsive-lg score-table mt-5 text-center">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã Môn</th>
                        <th>Tên Môn</th>
                        <th>Điểm CC</th>
                        <th>Điểm KT</th>
                        <th>Điểm TH</th>
                        <th>Điểm BT</th>
                        <th>Điểm Thi</th>
                        <th>Điểm TK(10)</th>
                        <th>Điểm TK(CH)</th>
                        <th>Kết Quả</th>
                    </tr>
                </thead>
                <tbody class="bangDiem">
                    <?php    
                        $sql = "select transcript.*, subject.*
                        from ((transcript
                        inner join subject on transcript.subjectID = subject.subjectID)
                        inner join student on transcript.studentID = student.studentID)
                        where student.studentID='{$_SESSION['userID']}' and subject.namHoc='2020-2021'
                        and subject.hocKy='1' order by transcript.transcriptID";
                        $index = 1;
                        $markList = executeResult($sql);
                        if (count($markList) !== 0)
                            foreach ($markList as $std) {
                                echo "<tr>
                                <td>" . ($index++) . "</td>
                                <td>{$std["maMon"]}</td>
                                <td>{$std["tenMon"]}</td>
                                <td>{$std["diemCC"]}</td>
                                <td>{$std["diemKT"]}</td>
                                <td>{$std["diemTH"]}</td>
                                <td>{$std["diemBT"]}</td>
                                <td>{$std["diemThi"]}</td>
                                <td>{$std["diemTK_so"]}</td>
                                <td>{$std["diemTK_chu"]}</td>
                                <td>{$std["ketQua"]}</td>
                            </tr>";
                            }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end score -->

    <!-- start personal info -->
    <div class="container-fluid personal-info" id="personal-info">
        <div class="score-title">
            <h2 class="text-center">THÔNG TIN CÁ NHÂN</h2>
        </div>

        <div class="">
            <h4 class="ml-sm-5 mt-3 mb-4">Thông tin cá nhân</h4>
        </div>

        <div class="d-flex justify-content-sm-center student-info ml-sm-5 my-4">
            <div class="mr-4">
                Tài khoản:<br>
                Họ tên:<br>
                Lớp:<br>
                Địa chỉ email:<br>
                Ngày sinh:<br>
                Quê quán:
            </div>

            <?php
            $sql = "select * from student where studentID='{$_SESSION['userID']}'";

            $index = 1;
            $studentList = executeResult($sql);
            if (count($studentList) !== 0)
                foreach ($studentList as $std) {
                    $date = date_create($std["ngaySinh"]);
                    $date = date_format($date, "d/m/Y");
                    echo "<div>
                                        <b>{$std["studentID"]}</b> <br>
                                        <b>{$std["ten"]}</b> <br>
                                        <b>{$std["lop"]}</b> <br>
                                        <b>{$std["email"]}</b><br>
                                        <b>{$date}</b><br>
                                        <b>{$std["queQuan"]}</b>
                                    </div>";
                }
            ?>
        </div>
        <!-- Start password-change section -->
        <div class="password-change">
            <h4 class="ml-sm-5 mt-5 mb-4">Thay đổi mật khẩu</h4>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex flex-column align-items-sm-center student-password ml-sm-5 my-4">
            <div class="mb-2">
                <div class="form-inline">
                    <label for="" class="mr-3">Nhập mật khẩu hiện tại:</label>
                    <input type="password" name="oldPass" id="" class="form-control pwd-input">
                </div>
            </div>

            <div class="mb-2">
                <div class="form-inline">
                    <label for="" class="mr-5">Nhập mật khẩu mới:</label>
                    <input type="password" name="newPass1" id="" class="form-control pwd-input">
                </div>
            </div>

            <div class="mb-2">
                <div class="form-inline">
                    <label for="" class="mr-4">Nhập lại mật khẩu mới:</label>
                    <input type="password" name="newPass2" id="" class="form-control pwd-input">
                </div>
            </div>

            <button type="submit" name="save-pwd" class="btn btn-success mt-4 save-btn d-block mx-auto">Lưu mật khẩu</button>
        </form>
        <!-- End password-change section -->
        <!-- end personal info -->

        <?php
        $s_oldPass = $s_newPass1 = $s_newPass2 = '';

        if (isset($_POST['save-pwd'])) {
            if (isset($_POST['oldPass'])) {
                $s_oldPass = $_POST['oldPass'];
            }

            if (isset($_POST['newPass1'])) {
                $s_newPass1 = $_POST['newPass1'];
            }

            if (isset($_POST['newPass2'])) {
                $s_newPass2 = $_POST['newPass2'];
            }

            if ($s_oldPass == '' || $s_newPass1 == '' || $s_newPass2 == '') {
                echo '
                                <script>
                                swal({
                                    title: "Đổi mật khẩu thất bại!",
                                    text: "Nhập thiếu mật khẩu!",
                                    icon: "error",
                                    button: "Ok",
                                });
                                </script>';
            } else {
                $sql = "select matKhau from student where studentID = '{$_SESSION['userID']}'";
                $res = executeResult($sql);

                foreach ($res as $value)
                    if (password_verify($s_oldPass, $value["matKhau"])) {
                        if (!strcmp($s_newPass1, $s_newPass2)) {
                            $s_hashed = password_hash($s_newPass1, PASSWORD_DEFAULT);

                            $sql = "update student set  matKhau='$s_hashed' 
                                where studentID='{$_SESSION['userID']}'";

                            execute($sql);

                            echo '
                                <script>
                                swal({
                                    title: "Đổi mật khẩu thành công!",
                                    text: "",
                                    icon: "success",
                                    button: "Ok",
                                });
                                </script>';
                        } else {
                            echo '
                                <script>
                                swal({
                                    title: "Đổi mật khẩu thất bại!",
                                    text: "Sai mật khẩu mới!",
                                    icon: "error",
                                    button: "Ok",
                                });
                                </script>';

                            
                        }
                    } else {
                        echo '
                                <script>
                                swal({
                                    title: "Đổi mật khẩu thất bại!",
                                    text: "Sai mật khẩu hiện tại!",
                                    icon: "error",
                                    button: "Ok",
                                });
                                </script>';
                    }
            }
        }

        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function(){
                $(document).ready(function(){
                    $('#hocKy').change (function(){
                    var txt = $('#hocKy').val();
                    $.post('../es_search/es_search.php', {data: txt}, function(data){
                        $('.lichThi').html(data);
                    })
                    })
                })

                $(document).ready(function(){
                    $('#hocKy1').change (function(){
                    var txt = $('#hocKy1').val();
                    $.post('../mark_search/mark_search.php', {data1: txt}, function(data){
                        $('.bangDiem').html(data);
                    })
                    })
        })

            
        });
        </script>
</body>

</html>