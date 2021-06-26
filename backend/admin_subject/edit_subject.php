<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectRoom_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectTeacher_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectYear_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectID_ex.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

$s_subjectID = $s_maMon = $s_name = $s_credit = $s_day = $s_lesson = $s_room = 
$s_teacher = $s_tuition = $s_term = $s_year = '';

//Nhập thông tin vào form từ csdl
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from subject where subjectID = '{$id}'";
    $subjectList = executeResult($sql);

    if (count($subjectList) > 0) {
        foreach ($subjectList as $std) {
            $s_subjectID = $std['subjectID'];
            $s_maMon = $std['maMon'];
            $s_name = $std['tenMon'];
            $s_credit = $std['soTinChi'];
            $s_day = $std['thu'];
            $s_lesson = $std['ca'];
            $s_room = $std['phong'];
            $s_teacher = $std['giangVien'];
            $s_tuition = $std['hocPhi'];
            $s_term = $std['hocKy'];
            $s_year = $std['namHoc'];
        }
    } else {
        $id = '';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa Thông Tin Môn Học</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center my-5">FORM NHẬP THÔNG TIN MÔN HỌC</h2>
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group d-none">
                        <label for="subjectID">subjectID</label>
                        <input required="true" type="text" class="form-control" id="id" name="subjectID" value="<?= $s_subjectID ?>">
                    </div>
                    <div class="form-group ">
                        <label for="maMon">Mã môn</label>
                        <input required="true" type="text" class="form-control" id="id" name="maMon" value="<?= $s_maMon ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Tên môn</label>
                        <input required="true" type="text" class="form-control" id="name" name="name" value="<?= $s_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="credit">Số tín chỉ</label>
                        <input required="true" type="number" class="form-control" id="credit" name="credit" min="1" value="<?= $s_credit ?>">
                    </div>
                    <div class="form-group">
                        <label for="day">Thứ</label>
                        <select class="form-control" name="day" id="day" value="<?= $s_day ?>">
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>Chủ nhật</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lesson">Ca</label>
                        <input required="true" type="number" class="form-control" id="lesson" name="lesson" min="1" max="6" value="<?= $s_lesson ?>">
                    </div>
                    <div class="form-group">
                        <label for="room">Phòng</label>
                        <input required="true" type="text" class="form-control" id="room" name="room" value="<?= $s_room ?>">
                    </div>
                    <div class="form-group">
                        <label for="teacher">Giảng viên</label>
                        <input required="true" type="text" class="form-control" id="teacher" name="teacher" value="<?= $s_teacher ?>">
                    </div>
                    <div class="form-group">
                        <label for="tuition">Học phí</label>
                        <input required="true" type="number" class="form-control" id="tuition" name="tuition" min="1" value="<?= $s_tuition ?>">
                    </div>
                    <div class="form-group">
                        <label for="term">Học kỳ</label>
                        <input required="true" type="number" class="form-control" id="term" name="term" min="1" max="2" value="<?= $s_term ?>">
                    </div>
                    <div class="form-group">
                        <label for="year">Năm học (YYYY-YYYY)</label>
                        <input required="true" type="text" class="form-control" id="year" name="year" value="<?= $s_year ?>">
                    </div>
                    <button class="btn btn-success mb-4" onmousedown="bleep.play()">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['room'])) {
        echo '
        <script>
        swal({
            title: "Sửa môn học thất bại!",
            text: "Phòng học không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['room']);
    }
    if (isset($_SESSION['teacher'])) {
        echo '
        <script>
        swal({
            title: "Sửa môn học thất bại!",
            text: "Tên giảng viên không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['teacher']);
    }
    if (isset($_SESSION['year'])) {
        echo '
        <script>
        swal({
            title: "Sửa môn học thất bại!",
            text: "Năm học không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['year']);
    }
    if (isset($_SESSION['subjectID'])) {
        echo '
        <script>
        swal({
            title: "Sửa môn học thất bại!",
            text: "Mã môn không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['subjectID']);
    }

    try {
        if (!empty($_POST)) {
            if (isset($_POST['subjectID'])) {
                $s_subjectID = $_POST['subjectID'];
            }

            if (isset($_POST['maMon'])) {
                $s_maMon = $_POST['maMon'];
            }
    
            if (isset($_POST['name'])) {
                $s_name = $_POST['name'];
            }
    
            if (isset($_POST['credit'])) {
                $s_credit = trim($_POST['credit']);
            }
    
            if (isset($_POST['day'])) {
                $s_day = trim($_POST['day']);
            }
    
            if (isset($_POST['lesson'])) {
                $s_lesson = trim($_POST['lesson']);
            }
    
            if (isset($_POST['room'])) {
                $s_room = trim($_POST['room']);
            }
    
            if (isset($_POST['teacher'])) {
                $s_teacher = trim($_POST['teacher']);
            }
    
            if (isset($_POST['tuition'])) {
                $s_tuition = trim($_POST['tuition']);
            }
    
            if (isset($_POST['term'])) {
                $s_term = trim($_POST['term']);
            }
    
            if (isset($_POST['year'])) {
                $s_year = trim($_POST['year']);
            }
    
            if (!preg_match("/[A-Z][A-Z][A-Z]\d\d\d\d$/i", $s_maMon)) {
                throw new SubjectidException();
            }
            if (!preg_match("/\d\d\d-[A-Z]\d$/i", $s_room)) {
                throw new SubjectRoomException();
            }
            for ($i = 0; $i < strlen($s_teacher); $i++) {
                if (is_numeric($s_teacher[$i]))
                    throw new SubjectTeacherException();
            }
            if (!preg_match("/\d\d\d\d\-\d\d\d\d$/i", $s_year)) {
                throw new SubjectYearException();
            }
    
            
    
    
            //Update
    
            $sql = "update subject set maMon='$s_maMon', tenMon='$s_name', soTinChi='$s_credit', 
                thu='$s_day', ca='$s_lesson', phong='$s_room', giangVien='$s_teacher', 
                hocPhi='$s_tuition', hocKy='$s_term', namHoc='$s_year' 
                where subjectID='{$s_subjectID}'";
    
    
            execute($sql);
    
            $_SESSION["edit_success"] = true;
            header('Location: admin_subject.php');
            die();
        }
    
        
    } catch (SubjectRoomException $e) {
        $_SESSION['room'] = true;
        header("Location: edit_subject.php?id={$s_subjectID}");
    } catch (SubjectTeacherException $e) {
        $_SESSION['teacher'] = true;
        header("Location: edit_subject.php?id={$s_subjectID}");
    } catch (SubjectYearException $e) {
        $_SESSION['year'] = true;
        header("Location: edit_subject.php?id={$s_subjectID}");
    } catch (SubjectidException $e) {
        $_SESSION['subjectID'] = true;
        header("Location: edit_subject.php?id={$s_subjectID}");
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