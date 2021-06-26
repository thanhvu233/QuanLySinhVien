<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentName_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentClass_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentEmail_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/home_ex.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

$s_id = $s_name = $s_class = $s_email = $s_dob = $s_home = $s_password = '';

//Nhập thông tin vào form từ csdl
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from student where studentID = '{$id}'";
    $studentList = executeResult($sql);

    if (count($studentList) > 0) {
        foreach ($studentList as $std) {
            $s_id = $std['studentID'];
            $s_name = $std['ten'];
            $s_class = $std['lop'];
            $s_email = $std['email'];
            $s_password = $std['matKhau'];
            $s_dob = $std['ngaySinh'];
            $s_home = $std['queQuan'];
        }
    } else {
        $id = '';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa Thông Tin Sinh Viên</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center my-5">FORM NHẬP THÔNG TIN SINH VIÊN</h2>
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group d-none">
                        <label for="id">Mã sinh viên</label>
                        <input required="true" type="text" class="form-control" id="id" name="id" value="<?= $s_id ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input required="true" type="text" class="form-control" id="name" name="name" value="<?= $s_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="class">Lớp</label>
                        <input required="true" type="text" class="form-control" id="class" name="class" value="<?= $s_class ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required="true" type="email" class="form-control" id="email" name="email" value="<?= $s_email ?>">
                    </div>
                    <div class="form-group">
                        <label for="dob">Ngày sinh</label>
                        <input required="true" type="date" class="form-control" id="dob" name="dob" value="<?= $s_dob ?>">
                    </div>
                    <div class="form-group">
                        <label for="home">Quê quán</label>
                        <input required="true" type="text" class="form-control" id="home" 
                        name="home" value="<?= $s_home ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button class="btn btn-success mb-4" onmousedown="bleep.play()">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['name'])) {
        echo '
        <script>
        swal({
            title: "Sửa sinh viên thất bại!",
            text: "Tên sinh viên không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['name']);
    }
    if (isset($_SESSION['class'])) {
        echo '
        <script>
        swal({
            title: "Sửa sinh viên thất bại!",
            text: "Lớp không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['class']);
    }
    if (isset($_SESSION['email'])) {
        echo '
        <script>
        swal({
            title: "Sửa sinh viên thất bại!",
            text: "Email không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['email']);
    }
    if (isset($_SESSION['home'])) {
        echo '
        <script>
        swal({
            title: "Sửa sinh viên thất bại!",
            text: "Quê quán không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['home']);
    }

    try {
        if (!empty($_POST)) {

            if (isset($_POST['id'])) {
                $s_id = $_POST['id'];
            }

            if (isset($_POST['name'])) {
                $s_name = $_POST['name'];
            }

            if (isset($_POST['class'])) {
                $s_class = $_POST['class'];
            }

            if (isset($_POST['email'])) {
                $s_email = $_POST['email'];
            }

            if (isset($_POST['dob'])) {
                $s_dob = $_POST['dob'];
            }

            if (isset($_POST['home'])) {
                $s_home = $_POST['home'];
            }

            if (isset($_POST['password'])) {
                $s_password = $_POST['password'];
            }

            for ($i = 0; $i < strlen($s_name); $i++) {
                if (is_numeric($s_name[$i]) || preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $s_name[$i]))
                    throw new StudentNameException();
            }
            if (!preg_match("/^[D]\d\d[A-Z][A-Z]\d\d$/", $s_class)) {
                throw new StudentClassException();
            }
            if (!preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $s_email)) {
                throw new StudentEmailException();
            }

            for ($i = 0; $i < strlen($s_home); $i++){
                if (is_numeric($s_home[$i]) || preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $s_name[$i]))
                    throw new HomeException();
            }

           

            $s_dob = date_create($s_dob);
            $s_dob = date_format($s_dob, "Y-m-d");

            //Update
            if (strlen($s_password) === 0)
                $sql = "update student set ten='$s_name', lop='$s_class', 
                email='$s_email', ngaySinh='$s_dob', queQuan='$s_home' where studentID='{$s_id}'";
            else {
                $s_hashed = password_hash($s_password, PASSWORD_DEFAULT);
                $sql = "update student set ten='$s_name', lop='$s_class', 
                email='$s_email', ngaySinh='$s_dob', queQuan='$s_home', matKhau='$s_hashed' where studentID='{$s_id}'";
            }

            execute($sql);

            $_SESSION["edit_success"] = true;
            header('Location: admin_student.php');
            die();
        }
    } catch (StudentNameException $e) {
        $_SESSION['name'] = true;
        header("Location: edit_student.php?id={$s_id}");
    } catch (StudentClassException $e) {
        $_SESSION['class'] = true;
        header("Location: edit_student.php?id={$s_id}");
    } catch (StudentEmailException $e) {
        $_SESSION['email'] = true;
        header("Location: edit_student.php?id={$s_id}");
    } catch (HomeException $e) {
        $_SESSION['home'] = true;
        header("Location: edit_student.php?id={$s_id}");
    }

    ?>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="./assets/js/click_sound.js"></script>
</body>

</html>