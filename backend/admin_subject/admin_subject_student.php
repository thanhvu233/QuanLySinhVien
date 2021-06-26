<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])) {
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
    <title>Môn học</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../assets/css/admin_subject_student.css">
</head>

<body>

    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="lab la-accusoft"></i> <span>Trang quản trị</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="../admin_home/admin_home.php"><span class="las la-igloo"></span>
                        <span>Trang Chủ</span></a>
                </li>
                <li>
                    <a href="../admin_student/admin_student.php"><span class="las la-user-circle"></span>
                        <span>Sinh Viên</span></a>
                </li>
                <li>
                    <a href="../admin_subject/admin_subject.php" class="active"><span class="las la-book"></span>
                        <span>Môn Học</span></a>
                    <ul class="sub-menu">
                        <li><a href="../admin_subject/admin_subject_student.php">Tra cứu theo sinh viên</a></li>
                        <li><a href="../admin_subject/admin_subject.php">Tra cứu theo môn</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../admin_mark/admin_mark.php" ><span class="las la-graduation-cap"></span>
                        <span>Điểm</span></a>
                </li>
                <li>
                    <a href="../admin_examSchedule/admin_examSchedule.php" ><span class="las la-calendar-alt"></span>
                        <span>Lịch Thi</span></a>
                </li>
                <li>
                    <a href="../admin_logout/admin_logout.php"><span class="las la-sign-out-alt"></span>
                        <span>Đăng Xuất</span></a>
                </li>
            </ul>
        </div>

    </div>

    <div class="main-content">
        <header>
            <label for="nav-toggle">
                <span class="las la-bars"></span>
            </label>

            <h3>MÔN HỌC</h3>

            <div class="user-wrapper">
                <img src="../assets/img/admin_page/photon_dragon.png" width="40px" height="40px" alt="">
                <div>
                    <h4>Admin</h4>
                </div>
            </div>
        </header>

        <main>
            <!-- start subject-search section -->
            <div class="subject-search">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                    <input type="text" placeholder="Nhập mã sinh viên hoặc tên sinh viên..." name="search" class="timKiem">
                    <input type="submit" value="Tìm kiếm">
                </form>
            </div>
            <!-- end subject-search section -->

            <!-- start subject-table section -->
            <div class="subject-table">
                <table width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã môn</th>
                            <th>Tên môn</th>
                            <th>Số tín chỉ</th>
                            <th>Học phí</th>
                        </tr>
                    </thead>
                    <tbody class="danhsach">
                        <?php
                        if (isset($_GET['search']) && $_GET['search'] !== ''){
                            $search = trim($_GET['search']);

                            $sql = "select subject.*
                            from ((examschedule
                            inner join subject on examschedule.subjectID = subject.subjectID)
                            inner join student on examschedule.studentID = student.studentID)
                            where student.studentID like '%{$search}%' or student.ten like '%{$search}%'
                            order by subject.subjectID";

                        }
                        else {
                            $sql =  "select subject.*
                                    from examschedule
                                    inner join subject on examschedule.subjectID = subject.subjectID
                                    order by subject.subjectID";
                        }


                            $index = 1;
                            $esList = executeResult($sql);
                            if (count($esList) !== 0)
                                foreach ($esList as $std) {
                                    echo "<tr>
                                    <td>".($index++)."</td>
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
            <!-- end subject-table section -->
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.timKiem').keyup(function() {
                var txt = $('.timKiem').val();
                $.post('subjectStudent_search.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            })
        })
    </script>
</body>

</html>