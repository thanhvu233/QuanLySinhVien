<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/es_ex/timeStartException_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectRoom_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/subject_ex/subjectYear_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/mark_ex/studentExist_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentID_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/mark_ex/subjectExist_ex.php";

session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

$s_esID = $s_studentID = $s_subjectID = $s_ngayThi = $s_gioBatDau = $s_thoiGianLamBai =
$s_phongThi = $s_hocKy = $s_namHoc = '';

//Nhập thông tin vào form từ csdl
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from examschedule where esID = '{$id}'";
    $esList = executeResult($sql);

    if (count($esList) > 0) {
        foreach ($esList as $std) {
            $s_esID = $std['esID'];
            $s_studentID = $std['studentID'];
            $s_subjectID = $std['subjectID'];
            $s_ngayThi = $std['ngayThi'];
            $s_gioBatDau = $std['gioBatDau'];
            $s_thoiGianLamBai = $std['thoiGianLamBai'];
            $s_phongThi = $std['phongThi'];
            $s_hocKy = $std['hocKy'];
            $s_namHoc = $std['namHoc'];
        }
    } else {
        $id = '';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa Lịch Thi</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center my-5">FORM NHẬP LỊCH THI</h2>
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group d-none">
                        <label for="esID">esID</label>
                        <input required="true" type="text" class="form-control" id="esID" 
                        name="esID" value="<?= $s_esID ?>">
                    </div>
                    <div class="form-group">
                        <label for="studentID">Mã sinh viên</label>
                        <input required="true" type="text" class="form-control" id="studentID" 
                        name="studentID" value="<?= $s_studentID ?>">
                    </div>
                    <div class="form-group">
                        <label for="subjectID">Mã môn</label>
                        <input required="true" type="text" class="form-control" id="subjectID" 
                        name="subjectID" value="<?= $s_subjectID ?>">
                    </div>
                    <div class="form-group">
                        <label for="ngayThi">Ngày thi</label>
                        <input required="true" type="date" class="form-control" id="ngayThi" 
                        name="ngayThi" value="<?= $s_ngayThi ?>">
                    </div>
                    <div class="form-group">
                        <label for="gioBatDau">Giờ bắt đầu (hh:mm)</label>
                        <input required="true" type="text" class="form-control" id="gioBatDau" 
                        name="gioBatDau" value="<?= $s_gioBatDau ?>">
                    </div>
                    <div class="form-group">
                        <label for="thoiGianLamBai">Thời gian làm bài</label>
                        <input type="number" class="form-control" id="thoiGianLamBai" 
                        name="thoiGianLamBai" min="1" value="<?= $s_thoiGianLamBai ?>">
                    </div>
                    <div class="form-group">
                        <label for="phongThi">Phòng thi</label>
                        <input type="text" class="form-control" id="phongThi" 
                        name="phongThi" value="<?= $s_phongThi ?>">
                    </div>
                    <div class="form-group">
                        <label for="hocKy">Học kỳ</label>
                        <input required="true" type="number" class="form-control" 
                        id="hocKy" name="hocKy" min="1" max="2" value="<?= $s_hocKy ?>">
                    </div>
                    <div class="form-group">
                        <label for="namHoc">Năm học (YYYY-YYYY)</label>
                        <input required="true" type="text" class="form-control" id="namHoc" 
                        name="namHoc" value="<?= $s_namHoc ?>">
                    </div>
                    <button class="btn btn-success mb-4" >Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['studentExist'])) {
        echo '
        <script>
        swal({
            title: "Sửa lịch thi thất bại!",
            text: "Sinh viên không tồn tại!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['studentExist']);
    }
    if (isset($_SESSION['studentid'])) {
        echo '
        <script>
        swal({
            title: "Sửa lịch thi thất bại!",
            text: "Mã sinh viên không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['studentid']);
    }
    if (isset($_SESSION['subjectExist'])) {
        echo '
        <script>
        swal({
            title: "Sửa lịch thi thất bại!",
            text: "Môn học không tồn tại!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['subjectExist']);
    }
    if (isset($_SESSION['timeStart'])) {
        echo '
        <script>
        swal({
            title: "Sửa lịch thi thất bại!",
            text: "Giờ bắt đầu không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['timeStart']);
    }
    if (isset($_SESSION['subjectRoom'])) {
        echo '
        <script>
        swal({
            title: "Sửa lịch thi thất bại!",
            text: "Phòng thi không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['subjectRoom']);
    }
    if (isset($_SESSION['subjectYear'])) {
        echo '
        <script>
        swal({
            title: "Sửa lịch thi thất bại!",
            text: "Năm học không hợp lệ!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        unset($_SESSION['subjectYear']);
    }

    try {
        if (!empty($_POST)) {
            if (isset($_POST['esID'])) {
                $s_esID = trim($_POST['esID']);
            }

            if (isset($_POST['studentID'])) {
                $s_studentID = trim($_POST['studentID']);
            }

            if (isset($_POST['subjectID'])) {
                $s_subjectID = trim($_POST['subjectID']);
            }

            if (isset($_POST['ngayThi'])) {
                $s_ngayThi = trim($_POST['ngayThi']);
            }

            if (isset($_POST['gioBatDau'])) {
                $s_gioBatDau = trim($_POST['gioBatDau']);
            }

            if (isset($_POST['thoiGianLamBai'])) {
                $s_thoiGianLamBai = trim($_POST['thoiGianLamBai']);
            }

            if (isset($_POST['phongThi'])) {
                $s_phongThi = trim($_POST['phongThi']);
            }

            if (isset($_POST['hocKy'])) {
                $s_hocKy = trim($_POST['hocKy']);
            }

            if (isset($_POST['namHoc'])) {
                $s_namHoc = trim($_POST['namHoc']);
            }

            $sql = "select studentID from student where studentID = '{$s_studentID}'";
            $studentList = executeResult($sql);

            // Kiểm tra sinh viên có tồn tại không?
            if (count($studentList) == 0) {
                throw new StudentExistException();
            }

            if (!preg_match("/[B]\d\d[D][C][A-Z][A-Z]\d\d\d/", $s_studentID)) {
                throw new StudentidException();
            }

            $sql = "select subjectID from subject where subjectID = '{$s_subjectID}'";
            $subjectList = executeResult($sql);
            // Kiểm tra môn học có tồn tại không?
            if (count($subjectList) == 0) {
                throw new SubjectExistException();
            }

            if (!preg_match("/\d\d:\d\d$/", $s_gioBatDau)) {
                throw new TimeStartException();
            }

            if (!preg_match("/\d\d\d-[A-Z]\d$/i", $s_phongThi)) {
                throw new SubjectRoomException();
            }

            if (!preg_match("/\d\d\d\d\-\d\d\d\d$/i", $s_namHoc)) {
                throw new SubjectYearException();
            }

            
            //Update
            $sql = "update examschedule set studentID='$s_studentID', subjectID='$s_subjectID', 
                ngayThi='$s_ngayThi', gioBatDau='$s_gioBatDau', thoiGianLamBai='$s_thoiGianLamBai', 
                phongThi='$s_phongThi', hocKy='$s_hocKy', namHoc='$s_namHoc'
                where esID='{$s_esID}'";

            execute($sql);

            $_SESSION["edit_success"] = true;
            header('Location: admin_examSchedule.php');
        }
    } catch (StudentExistException $e) {
        $_SESSION['studentExist'] = true;
        header("Location: edit_es.php?id={$s_esID}");
    } catch (StudentidException $e) {
        $_SESSION['studentid'] = true;
        header("Location: edit_es.php?id={$s_esID}");
    } catch (SubjectExistException $e) {
        $_SESSION['subjectExist'] = true;
        header("Location: edit_es.php?id={$s_esID}");
    } catch (TimeStartException $e) {
        $_SESSION['timeStart'] = true;
        header("Location: edit_es.php?id={$s_esID}");
    } catch (SubjectRoomException $e) {
        $_SESSION['subjectRoom'] = true;
        header("Location: edit_es.php?id={$s_esID}");
    } catch (SubjectYearException $e) {
        $_SESSION['subjectYear'] = true;
        header("Location: edit_es.php?id={$s_esID}");
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