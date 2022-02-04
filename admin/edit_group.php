<?php 

    require 'component/check_admin.php';
    $data_data = $_GET['groupname'];
    $data = $admin->data($data_data);
    $result = mysqli_fetch_array($data[1]);
    if(isset($_POST['btn-submit']) ) {
        $groupname = $_POST['groupname'];
        $MB = $_POST['MB'];
        $value = $MB * 1024000;
        $old_groupname = $_GET['groupname'];
        $change_group = $admin->change_group($groupname, $value, $old_groupname);
        if($change_group) {
            $Msg_suc = "Change group success.";
            header('refresh:1; url= group.php');
        }else {
            $Msg_err[] = "Error SQL change_group";
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
    <?php require 'style.php' ?>
</head>
<body>
    <?php require 'component/navbar.php' ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Groups</h1>
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
                                    <label for="" class="form-label text-capitalize">Groupname</label>
                                    <input required type="text" class="form-control" name="groupname" value="<?php echo $result['groupname'] ?>" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter groupname</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-capitalize">MB</label>
                                    <input required type="number" max="10" min="1" class="form-control" name="MB" value="<?php echo $result['value']/1024000 ?>" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Enter MB</small>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div>
                    <div class="text-center">

                        <input type="submit" value="Submit" name="btn-submit" class="btn btn-primary">
                        <a href="group.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>