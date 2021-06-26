<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentID_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentName_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentClass_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentEmail_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentDuplicate_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/home_ex.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sinh Viên</title>
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
                    <div class="form-group">
                        <label for="id">Mã sinh viên</label>
                        <input required="true" type="text" class="form-control" id="id" 
                        name="id">
                    </div>
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input required="true" type="text" class="form-control" id="name" 
                        name="name">
                    </div>
                    <div class="form-group">
                        <label for="class">Lớp</label>
                        <input required="true" type="text" class="form-control" id="class" 
                        name="class" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required="true" type="email" class="form-control" id="email" 
                        name="email" >
                    </div>
                    <div class="form-group">
                        <label for="dob">Ngày sinh</label>
                        <input required="true" type="date" class="form-control" id="dob" 
                        name="dob" >
                    </div>
                    <div class="form-group">
                        <label for="home">Quê quán</label>
                        <input required="true" type="text" class="form-control" id="home" 
                        name="home" >
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input required="true" type="password" class="form-control" id="password" 
                        name="password" >
                    </div>
                    <button class="btn btn-success mb-4" onmousedown="bleep.play()">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    $s_id = $s_name = $s_class = $s_email = $s_dob = $s_home = $s_password = '';

    try {
        if (!empty($_POST)) {
            if (isset($_POST['id'])) {
                $s_id = trim($_POST['id']);
            }
    
            if (isset($_POST['name'])) {
                $s_name = trim($_POST['name']);
            }
    
            if (isset($_POST['class'])) {
                $s_class = trim($_POST['class']);
            }
    
            if (isset($_POST['email'])) {
                $s_email = trim($_POST['email']);
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
    
            if (!preg_match("/[B]\d\d[D][C][A-Z][A-Z]\d\d\d/", $s_id)) {
                throw new StudentidException();
            }
            for ($i = 0; $i < strlen($s_name); $i++){
                if (is_numeric($s_name[$i]) || preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $s_name[$i]))
                    throw new StudentNameException();
            }
            if (!preg_match("/[D]\d\d[A-Z][A-Z]\d\d/", $s_class)) {
                throw new StudentClassException();
            }
            if (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
                throw new StudentEmailException();
            }

            for ($i = 0; $i < strlen($s_home); $i++){
                if (is_numeric($s_home[$i]) || preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $s_name[$i]))
                    throw new HomeException();
            }
    
            $sql1 = "select studentID from student where studentID = '{$s_id}'";
            $res = executeResult($sql1);
    
            // Kiểm tra có trùng mã sv k
            if (count($res) !== 0){
                throw new StudentDuplicateException();
            }
    
            $s_hashed = password_hash($s_password, PASSWORD_DEFAULT);
    
            //insert
            $sql = "insert into student(studentID, ten, lop, email, ngaySinh, queQuan, matkhau) 
            values ('$s_id', '$s_name', '$s_class', '$s_email', '$s_dob', '$s_home', '$s_hashed')";
    
            execute($sql);
            
            $_SESSION["input_success"] = true;
            header('Location: admin_student.php');
        }
    } catch (StudentidException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm sinh viên thất bại!",
                                        text: "Mã sinh viên không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (StudentNameException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm sinh viên thất bại!",
                                        text: "Tên sinh viên không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (StudentClassException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm sinh viên thất bại!",
                                        text: "Lớp không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (StudentEmailException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm sinh viên thất bại!",
                                        text: "Email sinh viên không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (StudentDuplicateException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm sinh viên thất bại!",
                                        text: "Mã sinh viên đã tồn tại!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (HomeException $e) {
        echo '
        <script>
        swal({
            title: "Thêm sinh viên thất bại!",
            text: "Quê quán không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
} 
    ?>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>

</html>