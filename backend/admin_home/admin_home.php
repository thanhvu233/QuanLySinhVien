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
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/admin_home.css">
</head>

<body>

    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="lab la-accusoft"></i> <span>Trang quản trị</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul class="main-menu">
                <li>
                    <a href="../admin_home/admin_home.php" class="active"><span class="las la-igloo"></span>
                        <span>Trang Chủ</span></a>
                </li>
                <li>
                    <a href="../admin_student/admin_student.php"><span class="las la-user-circle"></span>
                        <span>Sinh Viên</span></a>
                </li>
                <li>
                    <a href="../admin_subject/admin_subject.php"><span class="las la-book"></span>
                        <span>Môn Học</span></a>
                    <ul class="sub-menu">
                        <li><a href="../admin_subject/admin_subject_student.php">Tra cứu theo sinh viên</a></li>
                        <li><a href="../admin_subject/admin_subject.php">Tra cứu theo môn</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../admin_mark/admin_mark.php"><span class="las la-graduation-cap"></span>
                        <span>Điểm</span></a>
                </li>
                <li>
                    <a href="../admin_examSchedule/admin_examSchedule.php"><span class="las la-calendar-alt"></span>
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

            <h3>TRANG CHỦ</h3>

            <div class="user-wrapper">
                <img src="../assets/img/admin_page/photon_dragon.png" width="40px" height="40px" alt="">
                <div>
                    <h4>Admin</h4>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <?php
                        $sql = "select count(distinct studentID) as numberofstudents from student";
                        $result = executeResult($sql);
                        if (count($result) !== 0)
                            foreach ($result as $std) {
                                echo "
                                    <h1>" . $std["numberofstudents"] . "</h1>
                                    <span>Sinh viên</span>
                                    ";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $sql = "select count(distinct maMon) as numberofsubjects from subject";
                        $result = executeResult($sql);
                        if (count($result) !== 0)
                            foreach ($result as $std) {
                                echo "
                                    <h1>" . $std["numberofsubjects"] . "</h1>
                                    <span>Môn học</span>
                                    ";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="las la-book"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $sql = "select count(distinct transcriptID) as numberofmarks from transcript";
                        $result = executeResult($sql);
                        if (count($result) !== 0)
                            foreach ($result as $std) {
                                echo "
                                    <h1>" . $std["numberofmarks"] . "</h1>
                                    <span>Điểm</span>
                                    ";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="las la-graduation-cap"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $sql = "select count(esID) as numberofes from examschedule";
                        $result = executeResult($sql);
                        if (count($result) !== 0)
                            foreach ($result as $std) {
                                echo "
                                    <h1>" . $std["numberofes"] . "</h1>
                                    <span>Lịch thi</span>
                                    ";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="las la-calendar-alt"></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sinh viên sắp sinh nhật</h3>


                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>
                                                <h4>STT</h4>
                                            </td>
                                            <td>
                                                <h4>Mã SV</h4>
                                            </td>
                                            <td>
                                                <h4>Tên SV</h4>
                                            </td>
                                            <td>
                                                <h4>Lớp</h4>
                                            </td>
                                            <td>
                                                <h4>Ngày sinh</h4>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sql = "SELECT studentID, ten, lop, ngaySinh,
                ngaySinh + INTERVAL (YEAR(CURRENT_DATE) - YEAR(ngaySinh))     YEAR AS currbirthday,
                ngaySinh+ INTERVAL (YEAR(CURRENT_DATE) - YEAR(ngaySinh)) + 1 YEAR AS nextbirthday
                FROM student
                ORDER BY CASE
                WHEN currbirthday >= CURRENT_DATE THEN currbirthday
                ELSE nextbirthday
                END";

                                        $index = 1;
                                        $studentList = executeResult($sql);
                                        if (count($studentList) !== 0)
                                            foreach ($studentList as $std) {
                                                $date = date_create($std["ngaySinh"]);
                                                $date = date_format($date, "d/m/Y");
                                                echo "<tr>
                                                <td>" . ($index++) . "</td>
                                                <td>{$std["studentID"]}</td>
                                                <td>{$std["ten"]}</td>
                                                <td>{$std["lop"]}</td>
                                                <td>{$date}</td>
                                            </tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chart">
                <h4>Biểu đồ quê quán của sinh viên</h4>
                    <canvas id="myChart" width="100" height="100"> </canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "home_data.php",
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    var home = [];
                    var num = [];

                    for (var i in data) {
                        home.push(data[i].home);
                        num.push(data[i].num);
                        console.log(home);
                        console.log(num);
                    }

                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: home,
                            datasets: [{
                                data: num,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                hoverBackgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
</body>

</html>