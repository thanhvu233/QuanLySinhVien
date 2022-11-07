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
    <title>Điểm</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../assets/css/admin_mark.css">
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
                    <a href="../admin_subject/admin_subject.php"><span class="las la-book"></span>
                        <span>Môn Học</span></a>
                    <ul class="sub-menu">
                        <li><a href="../admin_subject/admin_subject_student.php">Tra cứu theo sinh viên</a></li>
                        <li><a href="../admin_subject/admin_subject.php">Tra cứu theo môn</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../admin_mark/admin_mark.php" class="active"><span class="las la-graduation-cap"></span>
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

            <h3>ĐIỂM</h3>

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
                <a href="input_mark.php" type="submit" name="add-btn" class="add-btn">Thêm</a href="">
            </div>
            <!-- end subject-search section -->

            <!-- start Check CRUD -->
            <?php
            if (isset($_SESSION["input_success"]) && $_SESSION["input_success"] == true) {
                echo '
                                    <script>
                                    swal({
                                        title: "Thêm điểm thành công!",
                                        text: "",
                                        icon: "success",
                                        button: "Ok",
                                    });
                                    </script>';

                unset($_SESSION['input_success']);
            } else if (isset($_SESSION["edit_success"]) && $_SESSION["edit_success"] == true) {
                echo '
                                    <script>
                                    swal({
                                        title: "Sửa điểm thành công!",
                                        text: "",
                                        icon: "success",
                                        button: "Ok",
                                    });
                                    </script>';

                unset($_SESSION['edit_success']);
            } else if (isset($_SESSION["delete_success"]) && $_SESSION["delete_success"] == true) {
                echo '
                                    <script>
                                    swal({
                                        title: "Xoá điểm thành công!",
                                        text: "",
                                        icon: "success",
                                        button: "Ok",
                                    });
                                    </script>';

                unset($_SESSION['delete_success']);
            }
            ?>
            <!-- end check CRUD -->

            <!-- start subject-table section -->
            <div class="subject-table">
                <table width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên môn</th>
                            <th>Điểm CC</th>
                            <th>Điểm KT</th>
                            <th>Điểm TH</th>
                            <th>Điểm BT</th>
                            <th>Điểm thi</th>
                            <th>TK(10)</th>
                            <th>TK(CH)</th>
                            <th>KQ</th>
                            <th>Sửa/Xoá</th>
                        </tr>
                    </thead>
                    <tbody class="danhsach">
                        <?php
                        if (isset($_GET['search']) && $_GET['search'] !== ''){
                            $search = trim($_GET['search']);

                            $sql = "select transcript.*, subject.tenMon
                                    from ((transcript
                                    inner join subject on transcript.subjectID = subject.subjectID)
                                    inner join student on transcript.studentID = student.studentID)
                                    where student.studentID like '%{$search}%' or student.ten like '%{$search}%'
                                    order by transcript.transcriptID";
                        }
                        else {
                            $sql =  "select transcript.*, subject.tenMon 
                                    from transcript
                                    inner join subject on transcript.subjectID = subject.subjectID
                                    order by transcript.transcriptID";
                        }

                            $index = 1;
                            $markList = executeResult($sql);
                            if (count($markList) !== 0)
                                foreach ($markList as $std) {
                                    echo "<tr>
                                    <td>".($index++)."</td>
                                    <td>{$std["tenMon"]}</td>
                                    <td>{$std["diemCC"]}</td>
                                    <td>{$std["diemKT"]}</td>
                                    <td>{$std["diemTH"]}</td>
                                    <td>{$std["diemBT"]}</td>
                                    <td>{$std["diemThi"]}</td>
                                    <td>{$std["diemTK_so"]}</td>
                                    <td>{$std["diemTK_chu"]}</td>
                                    <td>{$std["ketQua"]}</td>
                                    <td>
                                        
                                        <a href='edit_mark.php?id={$std["transcriptID"]}' class='edit-btn' 
                                        name='edit-btn'><i class='las la-pen'></i></a>
                                        <a href='delete_mark.php?id={$std["transcriptID"]}' class='delete-btn' 
                                        name='delete-btn'><i class='las la-trash-alt'></i></a>
                                        
                                    </td>
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
                $.post('mark_search.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            })
        })
    </script>
</body>

</html>