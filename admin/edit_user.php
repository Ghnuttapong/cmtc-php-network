<?php 

    include 'component/check_admin.php';
    $data_data = $_GET['username'];

    $data = $admin->data($data_data);
    $result = mysqli_fetch_array($data[2]);
    if(isset($_POST['btn-change-profile'])) {
        
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $groupname = $_POST['groupname'];
        $data_data = $groupname;
        $data = $admin->data($data_data);
        $get_value = mysqli_fetch_array($data[1]);
        $value = $get_value['value'];

        if($old_password != $result['value']) {
            $Msg_err[] = 'Check your old password.';
        }elseif($_POST['new_password'] == "" ) {
            $new_password = $old_password;
            $change_profile_user = $admin->change_profile_user($fullname, $username,  $new_password, $groupname, $value);
            if($change_profile_user) {
                $Msg_suc = "Change profile successful.";
                header('refresh:1; url= ./user.php ');
            }else {
                $Msg_err[] = "Error SQL change_profile_user.";
            }
        }else {
            $change_profile_user = $admin->change_profile_user($fullname, $username,  $new_password, $groupname, $value);
            if($change_profile_user) {
                $Msg_suc = "Change profile successful.";
                header('refresh:1; url= ./user.php ');
            }else {
                $Msg_err[] = "Error SQL change_profile_user.";
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
    <?php include 'component/navbar.php' ?>
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
                                    <input required type="text" class="form-control" name="fullname" value="<?php echo $result['fullname'] ?>" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter fullname</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">username</label>
                                    <input required type="text" disabled class="form-control" name="username" id="" value="<?php echo $result['username'] ?>" aria-describedby="helpId" placeholder="">
                                    <input required type="hidden" class="form-control" name="username" id="" value="<?php echo $result['username'] ?>" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter username</small>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">old password</label>
                                    <input type="password" class="form-control" name="old_password" id="" value="<?php echo $result['value'] ?>" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter old password</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">new password</label>
                                    <input  type="password" class="form-control" name="new_password" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter new password</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <select class="form-select" name="groupname" id="">
                                    <?php   
                                        $data_all = $admin->data_all() ; 
                                        while($row = mysqli_fetch_array($data_all[1])) {
                                    ?>
                                        <option value="<?php echo $row['groupname'] ?>"><?php echo $row['groupname'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div><!-- end row -->
                    </div>
                    <div class="text-center my-4">
                        <input type="submit" value="Change" name="btn-change-profile" class="btn btn-primary">
                        <a href="./user.php" class="btn btn-secondary">Go back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>