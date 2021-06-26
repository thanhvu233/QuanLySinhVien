<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectID_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectRoom_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectTeacher_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectYear_ex.php";

session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm Môn Học</title>
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
                    <div class="form-group">
                        <label for="maMon">Mã môn</label>
                        <input required="true" type="text" class="form-control" id="maMon" 
                        name="maMon">
                    </div>
                    <div class="form-group">
                        <label for="name">Tên môn</label>
                        <input required="true" type="text" class="form-control" id="name" 
                        name="name">
                    </div>
                    <div class="form-group">
                        <label for="credit">Số tín chỉ</label>
                        <input required="true" type="number" class="form-control" id="credit" 
                        name="credit" min="1">
                    </div>
                    <div class="form-group">
                      <label for="day">Thứ</label>
                      <select class="form-control" name="day" id="day">
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
                        <input required="true" type="number" class="form-control" id="lesson" 
                        name="lesson" min="1" max="6">
                    </div>
                    <div class="form-group">
                        <label for="room">Phòng</label>
                        <input required="true" type="text" class="form-control" id="room" 
                        name="room" >
                    </div>
                    <div class="form-group">
                        <label for="teacher">Giảng viên</label>
                        <input required="true" type="text" class="form-control" id="teacher" 
                        name="teacher" >
                    </div>
                    <div class="form-group">
                        <label for="tuition">Học phí</label>
                        <input required="true" type="number" class="form-control" id="tuition" 
                        name="tuition" min="1">
                    </div>
                    <div class="form-group">
                        <label for="term">Học kỳ</label>
                        <input required="true" type="number" class="form-control" id="term" 
                        name="term" min="1" max="2">
                    </div>
                    <div class="form-group">
                        <label for="year">Năm học (YYYY-YYYY)</label>
                        <input required="true" type="text" class="form-control" id="year" 
                        name="year" >
                    </div>
                    <button class="btn btn-success mb-4">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    $s_maMon = $s_name = $s_credit = $s_day = $s_lesson = $s_room = $s_teacher 
    = $s_tuition = $s_term = $s_year = '';

    try {
        if (!empty($_POST)) {
            if (isset($_POST['maMon'])) {
                $s_maMon = trim($_POST['maMon']);
            }
    
            if (isset($_POST['name'])) {
                $s_name = trim($_POST['name']);
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
            for ($i = 0; $i < strlen($s_teacher); $i++){
                if (is_numeric($s_teacher[$i]))
                    throw new SubjectTeacherException();
            }
            if (!preg_match("/\d\d\d\d\-\d\d\d\d$/i", $s_year)) {
                throw new SubjectYearException();
            }
    
            
    
            
        
            //insert
            $sql = "insert into subject(maMon, tenMon, soTinChi, 
            thu, ca, phong, giangVien, hocPhi, hocKy, namHoc) values 
            ('$s_maMon', '$s_name', '$s_credit', '$s_day', '$s_lesson', '$s_room',
            '$s_teacher', '$s_tuition', '$s_term', '$s_year')";
    
            execute($sql);
            
            $_SESSION["input_success"] = true;
            header('Location: admin_subject.php');
        }
    } catch (SubjectidException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm môn học thất bại!",
                                        text: "Mã môn học không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    }   catch (SubjectRoomException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm môn học thất bại!",
                                        text: "Phòng học không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (SubjectTeacherException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm môn học thất bại!",
                                        text: "Tên giảng viên không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (SubjectYearException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm môn học thất bại!",
                                        text: "Năm học không hợp lệ!",
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