<?php 

    include "inc/function.php";
    $register = new dbcon;

    if(isset($_POST['btn-register'])) {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $password_con = $_POST['password_con'];

        if($password != $password_con) {
            $Msg_err[] = "Password your don't match.";
        }else {
            $check_register = $register->check_register($username);
            if(mysqli_num_rows($check_register) > 0) {
                $Msg_err[] = "Username already taken.";
            }else {
                $user_register = $register->user_register($username, $password, $fullname);
                if($user_register) {
                    $Msg_suc = "Successfully Register.";
                    header('refresh:1;');
                }else {
                    $Msg_err[] = "Error SQL:";
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div class="container mt-5">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center text-success my-5">Register</h1>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input required type="text" class="form-control" name="fullname" id="fullname" aria-describedby="fullname" placeholder="Fullname">
                            </div>
                        </div>
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <input required type="password" class="form-control" name="password_con" id="password_con" aria-describedby="password_con" placeholder="Confirm pasword">
                            </div>
                        </div>
                        <div class="text-center my-3">
                            <input type="submit" name="btn-register" id="" value="Register" class="w-50 btn btn-success">
                            <br>
                            <a href="./" class="btn btn-link">Login Now!</a>
                        </div>
                    </div><!-- end row -->
                </form>
            </div>
        </div>

    </div>    
</body>
</html>