<?php 
    @session_start();
    include "inc/function.php";
    $login = new dbcon;

    if(isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $check_login = $login->check_login($username, $password);

        if(mysqli_num_rows($check_login[0]) > 0) {
            $Msg_suc = "Login successfully....";
            $check_admin = mysqli_fetch_array($check_login[0]);
            $_SESSION['username'] = $check_admin['username'];
            $_SESSION['fullname'] = $check_admin['fullname'];
            $_SESSION['password'] = $check_admin['value'];
            $_SESSION['attribute'] = $check_admin['attribute'];
            if($_SESSION['username'] == "admin") {
                header('refresh:1; url= admin/');
            }elseif($check_admin['attribute'] != 'Cleartext-Password') {
                header('refresh:1; url= user/blocked.php ');
            }else{
                $check_group = mysqli_fetch_array($check_login[1]);
                $_SESSION['groupname'] = $check_group['groupname'];
                $_SESSION['priority'] = $check_group['priority'];
                if($check_group['groupname'] == 'pending') {
                    header('refresh:1; url= user/pending.php');
                }else {
                    header('refresh:1; url= user/');
                }
            }
        } else{
            $Msg_err[] = "Invalid username";
        }
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div class="container mt-5">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center text-success my-5">Login</h1>
                <?php if(isset($Msg_err)) { foreach ($Msg_err as $error) {?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $error ?></p>
                    </div>
                <?php }} ?>
                <?php if(isset($Msg_suc)) {?>
                    <div class="alert alert-success" role="alert">
                        <p><?php echo $Msg_suc ?></p>
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <input required type="text" class="form-control" name="username" id="username" aria-describedby="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <input required type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="text-center my-3">
                            <input type="submit" name="btn-login" id="" value="Login" class="w-50 btn btn-success">
                        </div>
                    </div><!-- end row -->
                </form>
            </div>
        </div>

    </div>    
</body>
</html>