<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/mark_ex/studentExist_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/student_ex/studentID_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/mark_ex/subjectExist_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/mark_ex/mark_ex.php";
require_once "/xampp/htdocs/QuanLySinhVien/backend/exceptions/mark_ex/chracterMark_ex.php";


session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm Điểm</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center my-5">FORM NHẬP ĐIỂM</h2>
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="studentID">Mã sinh viên</label>
                        <input required="true" type="text" class="form-control" id="studentID" 
                        name="studentID">
                    </div>
                    <div class="form-group">
                        <label for="subjectID">Mã môn</label>
                        <input required="true" type="text" class="form-control" id="subjectID" 
                        name="subjectID">
                    </div>
                    <div class="form-group">
                        <label for="diemCC">Điểm chuyên cần</label>
                        <input required="true" type="text" class="form-control" id="diemCC" 
                        name="diemCC">
                    </div>
                    <div class="form-group">
                        <label for="diemKT">Điểm kiểm tra</label>
                        <input required="true" type="text" class="form-control" id="diemKT" 
                        name="diemKT">
                    </div>
                    <div class="form-group">
                        <label for="diemTH">Điểm thực hành</label>
                        <input type="text" class="form-control" id="diemTH" 
                        name="diemTH">
                    </div>
                    <div class="form-group">
                        <label for="diemBT">Điểm bài tập</label>
                        <input type="text" class="form-control" id="diemBT" 
                        name="diemBT">
                    </div>
                    <div class="form-group">
                        <label for="diemThi">Điểm thi</label>
                        <input required="true" type="text" class="form-control" id="diemThi" 
                        name="diemThi">
                    </div>
                    <div class="form-group">
                        <label for="diemTK_so">Điểm tổng kết (số)</label>
                        <input required="true" type="text" class="form-control" id="diemTK_so" 
                        name="diemTK_so">
                    </div>
                    <div class="form-group">
                        <label for="diemTK_chu">Điểm tổng kết (chữ)</label>
                        <input required="true" type="text" class="form-control" id="diemTK_chu" 
                        name="diemTK_chu">
                    </div>
                    <div class="form-group">
                      <label for="ketQua">Kết quả</label>
                      <select class="form-control" name="ketQua" id="">
                        <option>Đạt</option>
                        <option>X</option>
                      </select>
                    </div>
                    <button class="btn btn-success mb-4">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    $s_studentID = $s_subjectID = $s_diemCC = $s_diemKT = $s_diemTH = $s_diemtBT = $s_diemThi =
    $s_diemTK_chu = $s_diemTK_so = $s_ketQua = '';

    try {
        if (!empty($_POST)) {
            if (isset($_POST['studentID'])) {
                $s_studentID = trim($_POST['studentID']);
            }
    
            if (isset($_POST['subjectID'])) {
                $s_subjectID = trim($_POST['subjectID']);
            }
    
            if (isset($_POST['diemCC'])) {
                $s_diemCC = trim($_POST['diemCC']);
            }
    
            if (isset($_POST['diemKT'])) {
                $s_diemKT = trim($_POST['diemKT']);
            }
    
            if (isset($_POST['diemTH'])) {
                $s_diemTH = trim($_POST['diemTH']);
            }
    
            if (isset($_POST['diemBT'])) {
                $s_diemBT = trim($_POST['diemBT']);
            }

            if (isset($_POST['diemThi'])) {
                $s_diemThi = trim($_POST['diemThi']);
            }

            if (isset($_POST['diemTK_so'])) {
                $s_diemTK_so = trim($_POST['diemTK_so']);
            }

            if (isset($_POST['diemTK_chu'])) {
                $s_diemTK_chu = trim($_POST['diemTK_chu']);
            }

            if (isset($_POST['ketQua'])) {
                $s_ketQua = trim($_POST['ketQua']);
            }
    
            $sql = "select studentID from student where studentID = '{$s_studentID}'";
            $studentList = executeResult($sql);
            
            // Kiểm tra sinh viên có tồn tại không?
            if (count($studentList) == 0){
                throw new StudentExistException();
            }

            if (!preg_match("/[B]\d\d[D][C][A-Z][A-Z]\d\d\d/", $s_studentID)) {
                throw new StudentidException();
            }

            $sql = "select subjectID from subject where subjectID = '{$s_subjectID}'";
            $subjectList = executeResult($sql);
            // Kiểm tra môn học có tồn tại không?
            if (count($subjectList) == 0){
                throw new SubjectExistException();
            }

            if ($s_diemCC < 0 || $s_diemCC > 10){
                throw new MarkException();
            }

            if ($s_diemKT < 0 || $s_diemKT > 10){
                throw new MarkException();
            }

            if (($s_diemTH < 0 || $s_diemTH > 10) && $s_diemTH != ""){
                throw new MarkException();
            }

            if (($s_diemBT < 0 || $s_diemBT > 10) && $s_diemBT != ""){
                throw new MarkException();
            }

            if ($s_diemThi < 0 || $s_diemThi > 10){
                throw new MarkException();
            }

            if ($s_diemTK_so < 0 || $s_diemTK_so > 10){
                throw new MarkException();
            }
            
            if (!preg_match("/[A-F][+\-]$|[A-F]$/", $s_diemTK_chu)) {
                throw new ChracterMarkException();
            }
    
            
            //insert
            if ($s_diemTH == ""){
            $sql = "insert into transcript(studentID, subjectID, diemCC, 
            diemKT, diemBT, diemThi, diemTK_so, diemTK_chu, ketQua) values 
            ('$s_studentID', '$s_subjectID', '$s_diemCC', '$s_diemKT', '$s_diemBT',
            '$s_diemThi', '$s_diemTK_so', '$s_diemTK_chu', '$s_ketQua')";}
            
            else if ($s_diemBT == ""){
            $sql = "insert into transcript(studentID, subjectID, diemCC, 
            diemKT, diemTH, diemThi, diemTK_so, diemTK_chu, ketQua) values 
            ('$s_studentID', '$s_subjectID', '$s_diemCC', '$s_diemKT', '$s_diemTH',
            '$s_diemThi', '$s_diemTK_so', '$s_diemTK_chu', '$s_ketQua')";}
            
            execute($sql);
            
            $_SESSION["input_success"] = true;
            header('Location: admin_mark.php');
        }
    } catch (StudentExistException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm điểm thất bại!",
                                        text: "Sinh viên không tồn tại!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    }   catch (StudentidException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm điểm thất bại!",
                                        text: "Mã sinh viên không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (SubjectExistException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm điểm thất bại!",
                                        text: "Mã môn học không tồn tại!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (MarkException $e) {
                                    echo '
                                    <script>
                                    swal({
                                        title: "Thêm điểm thất bại!",
                                        text: "Điểm bằng số không hợp lệ!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
    } catch (ChracterMarkException $e) {
        echo '
        <script>
        swal({
            title: "Thêm điểm thất bại!",
            text: "Điểm bằng chữ không hợp lệ!",
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