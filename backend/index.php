<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="./assets/img/login/undraw_teaching_f1cm.svg" alt="image" class="img-fluid">
            </div>
            <div class="col-md-6 mb-3">
                <h3 class="signin-text mb-3 text-center">Welcome to PTIT</h3>
                <?php
                // $error = "";
                if (isset($_POST["login"])) {
                    $sql = "select * from admin where account='{$_POST["account"]}'";
                    $res = executeResult($sql);

                    if (count($res) > 0) {
                        foreach ($res as $value)
                            if (password_verify($_POST["password"], $value["password"])) {
                                $_SESSION["adminID"] = $value["adminID"];
                                $_SESSION["account"] = $value["account"];
                                // $error = "";
                                header("Location: ./admin_home/admin_home.php");
                            } else {
                                echo '
                                <script>
                                swal({
                                    title: "Đăng nhập thất bại!",
                                    text: "Sai thông tin đăng nhập!",
                                    icon: "error",
                                    button: "Ok",
                                });
                                </script>';
                            }
                    } 
                    else {
                        $sql = "select * from student where studentID='{$_POST["account"]}'";
                        $res = executeResult($sql);

                        if (count($res) > 0) {
                            foreach ($res as $value)
                                if (password_verify($_POST["password"], $value["matKhau"])) {
                                    $_SESSION["userID"] = $value["studentID"];
                                    // $_SESSION["account"] = $value["account"];
                                    // $error = "";
                                    header("Location: ../../frontend/index/index.php");
                                } else {
                                    echo '
                                <script>
                                swal({
                                    title: "Đăng nhập thất bại!",
                                    text: "Sai thông tin đăng nhập!",
                                    icon: "error",
                                    button: "Ok",
                                });
                                </script>';
                                }
                        }
                    }

                        echo '
                                <script>
                                swal({
                                    title: "Đăng nhập thất bại!",
                                    text: "Sai thông tin đăng nhập!",
                                    icon: "error",
                                    button: "Ok",
                                });
                                </script>';
                    
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="account">Tài khoản</label>
                        <input type="text" class="form-control" name="account" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-class d-block mx-auto" name="login">Đăng nhập</button>

                </form>
            </div>
        </div>
    </div>


</body>

</html>