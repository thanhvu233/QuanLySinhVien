<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
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
    <title>Sinh Viên</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../assets/css/admin_student.css">
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
                    <a href="../admin_student/admin_student.php" class="active"><span class="las la-user-circle"></span>
                        <span>Sinh Viên</span></a>
                </li>
                <li>
                    <a href="../admin_subject/admin_subject.php"><span class="las la-book"></span>
                        <span>Môn Học</span></a>
                    <ul class="sub-menu">
                        <li><a href="../admin_subject/admin_subject_student.php" >Tra cứu theo sinh viên</a></li>
                        <li><a href="../admin_subject/admin_subject.php" >Tra cứu theo môn</a></li>
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

            <h3>SINH VIÊN</h3>

            <div class="user-wrapper">
                <img src="../assets/img/admin_page/photon_dragon.png" width="40px" height="40px" alt="">
                <div>
                    <h4>Admin</h4>
                </div>
            </div>
        </header>

        <main>
            <!-- start student-search section -->
            <div class="student-search">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                    <input type="text" placeholder="Nhập mã sinh viên hoặc tên sinh viên..." name="search" class="timKiem">
                    <input type="submit" value="Tìm kiếm">
                </form>
                <a href="input_student.php" type="submit" name="add-btn" class="add-btn">Thêm sinh viên</a href="">
            </div>
            <!-- end student-search section -->

            <!-- start Check CRUD -->
                <?php
                if (isset($_SESSION["input_success"]) && $_SESSION["input_success"] == true){
                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm sinh viên thành công!",
                                        text: "",
                                        icon: "success",
                                        button: "Ok",
                                    });
                                    </script>';
                
                    unset($_SESSION['input_success']);
                }
                else if (isset($_SESSION["edit_success"]) && $_SESSION["edit_success"] == true){
                    echo '
                                    <script>
                                    swal({
                                        title: "Sửa thông tin sinh viên thành công!",
                                        text: "",
                                        icon: "success",
                                        button: "Ok",
                                    });
                                    </script>';
                
                    unset($_SESSION['edit_success']);
                }
                else if (isset($_SESSION["delete_success"]) && $_SESSION["delete_success"] == true){
                    echo '
                                    <script>
                                    swal({
                                        title: "Xoá sinh viên thành công!",
                                        text: "",
                                        icon: "success",
                                        button: "Ok",
                                    });
                                    </script>';
                
                    unset($_SESSION['delete_success']);
                }
                ?>
            <!-- end check CRUD -->

            <!-- start student-table section -->
            <div class="student-table">
                <table width="100%">
                
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã SV</th>
                            <th>Tên</th>
                            <th>Lớp</th>
                            <th>Email</th>
                            <th>Ngày sinh</th>
                            <th>Quê quán</th>
                            <th>Sửa/Xoá</th>
                        </tr>
                    </thead>
                    <tbody class="danhsach">
                        <?php
                        if (isset($_GET['search']) && $_GET['search'] !== ''){
                            $search = trim($_GET['search']);

                            if (preg_match('/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/', $search)){
                                $search = date_create_from_format("d/m/Y", $search);
                                $search = date_format($search, "Y-m-d");

                            }

                            $sql = "select * from student where studentID like '%{$search}%' or
                                    ten like '%{$search}%' or lop like '%{$search}%' or
                                    email like '%{$search}%' or ngaySinh like '%{$search}%'
                                    or queQuan like '%{$search}%'";
                        }
                        else {
                            $sql =  "select * from student";
                        }

                        $index = 1;
                        $studentList = executeResult($sql);
                        if (count($studentList) !== 0)
                            foreach ($studentList as $std) {
                                $date = date_create ($std["ngaySinh"]);
                                $date = date_format ($date, "d/m/Y");
                                echo "<tr>
                                    <td>".($index++)."</td>
                                    <td>{$std["studentID"]}</td>
                                    <td>{$std["ten"]}</td>
                                    <td>{$std["lop"]}</td>
                                    <td>{$std["email"]}</td>
                                    <td>{$date}</td>
                                    <td>{$std["queQuan"]}</td>
                                    <td>
                                        
                                        <a href='edit_student.php?id={$std["studentID"]}' class='edit-btn' 
                                        name='edit-btn'><i class='las la-pen'></i></a>
                                        <a href='delete_student.php?id={$std["studentID"]}' class='delete-btn' 
                                        name='delete-btn'><i class='las la-trash-alt'></i></a>
                                        
                                    </td>
                                </tr>";
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- end student-table section -->
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.timKiem').keyup (function(){
            var txt = $('.timKiem').val();
            $.post('student_search.php', {data: txt}, function(data){
                $('.danhsach').html(data);
            })
            })
        })
        
    </script>
</body>

</html>