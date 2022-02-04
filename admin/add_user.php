<?php 

    include 'component/check_admin.php';
    // check error
    $Msg_count_suc = 0;
    $Msg_count_err = 0;
    if(isset($_POST['btn-register-by-admin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $groupname = $_POST['groupname'];
        $fullname = $_POST['fullname'];
        
        $data_data = $groupname;
        $data = $admin->data($data_data);
        $get_value = mysqli_fetch_array($data[1]);
        $value = $get_value['value'];
        $count = count($username);

    

        if($count > 1) {
          
            for($i = 0; $i < $count; $i++) {
                $check_register = $admin->check_register($username[$i]);
                if(mysqli_num_rows($check_register) > 0) {
                    $Msg_count_err  += 1;
                } else {
                    $register_by_admin = $admin->register_by_admin($fullname[$i], $username[$i], $password[$i], $groupname, $value); 
                    if($register_by_admin) {
                        $Msg_count_suc += 1;
                    }
                }
            }
        }else {
        
            $check_register = $admin->check_register($username[0]);
            if(mysqli_num_rows($check_register) > 0) {
                $Msg_count_err += 1;
            } else {
                $register_by_admin = $admin->register_by_admin($fullname[0], $username[0], $password[0], $groupname, $value); 
                if($register_by_admin) {
                    $Msg_count_suc += 1;
                }
            }

        }
    }

    $data_all = $admin->data_all() ;
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
        <h1 class="text-center">Add User</h1>        
        <div class="float-end">
            <button onclick="add_input()" class="btn btn-secondary">+</button>
        </div>
        <form action="" method="post">
        <input type="submit" value="Add" class="btn btn-primary" name="btn-register-by-admin">
       <hr>
       <!-- check error -->
            <?php if(($Msg_count_err) != 0) { ?>
                <div class="alert alert-danger" role="alert">
                    <p>failed <?php echo $Msg_count_err ?> times</p>
                </div>
            <?php } ?>
            <?php if(($Msg_count_suc) != 0 ) { ?>
                <div class="alert alert-success" role="alert">
                    <p>successful <?php echo $Msg_count_suc ?> times</p>
                </div>
            <?php } ?>
       <!-- end check  -->
            <select class="form-select my-4" name="groupname" id="">
                <?php while($row = mysqli_fetch_array($data_all[1])) { ?>
                    <option value="<?php echo $row['groupname'] ?>"><?php echo $row['groupname'] ?></option>
                <?php } ?>
            </select>
            <!-- input -->
            <div class="row" id="add-input">
                <div class="col-md-4">
                    <div class="mb-3">
                      <label for="" class="form-label text-capitalize">fullname</label>
                      <input required type="text" class="form-control" name="fullname[]" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Enter fullname</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                      <label for="" class="form-label text-capitalize">username</label>
                      <input required type="text" class="form-control" name="username[]" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Enter username</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                      <label for="" class="form-label text-capitalize">password</label>
                      <input required type="password" class="form-control" name="password[]" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Enter password</small>
                    </div>
                </div>
            </div>
       </form>
        
    </div>

    <script>
        function add_input() {
            let html = `
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label text-capitalize">fullname</label>
                    <input required type="text" class="form-control" name="fullname[]" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Enter fullname</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label text-capitalize">username</label>
                    <input required type="text" class="form-control" name="username[]" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Enter username</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label text-capitalize">password</label>
                    <input required type="password" class="form-control" name="password[]" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Enter password</small>
                </div>
            </div>
            `

            document.getElementById('add-input').innerHTML += html
        }

    </script>
</body>
</html>