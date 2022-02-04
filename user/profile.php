<?php 

    require 'check_user.php';


    if(isset($_POST['btn-change-profile'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        if($old_password != $_SESSION['password']) {
            $Msg_err[] = 'Check your old password.';
        }else {
            $change_profile = $user->change_profile($fullname, $username,  $new_password);
            if($change_profile) {
                $Msg_suc = "Change profile successful.";
                header('refresh:1; url= ./ ');
            }else {
                $Msg_err[] = "Error SQL change_profile.";
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
    <title><?php echo $_SESSION['username'] ?></title>
    <?php include_once 'style.php' ?>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Profile</h1>
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
                    <div class="card-text">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">fullname</label>
                                    <input required type="text" class="form-control" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter fullname</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">username</label>
                                    <input required type="text" disabled class="form-control" name="username" id="" value="<?php echo $_SESSION['username'] ?>" aria-describedby="helpId" placeholder="">
                                    <input required type="hidden" class="form-control" name="username" id="" value="<?php echo $_SESSION['username'] ?>" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter username</small>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">old password</label>
                                    <input required type="password" class="form-control" name="old_password" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter old password</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">new password</label>
                                    <input required type="password" class="form-control" name="new_password" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter new password</small>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div>
                    <input type="submit" value="Change" name="btn-change-profile" class="btn btn-primary">
                    <a href="./" class="btn btn-secondary">Go back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>