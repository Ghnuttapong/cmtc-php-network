<?php 
    include 'component/check_admin.php';
    $data_data = "pending";
    $data = $admin->data($data_data);

    if(isset($_POST['btn-add-pending'])) {
        $groupname = $_POST['groupname'];
        $username = $_POST['username'];
        $data_data = $groupname;
        $data = $admin->data($data_data);
        $get_value = mysqli_fetch_array($data[1]);
        $value = $get_value['value'];
        $add_pending = $admin->add_pending($groupname, $username, $value);
        if($add_pending) {
            header('refresh:0.5;');
        }else {
            echo "Error SQL: ";
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
        <h1 class="text-center">Pending</h1>
        <hr>    
        <table class="table table-striped table-hover table-inverse table-responsive">
            <thead class="thead-inverse text-capitalize">
                <tr>
                    <th>#</th>
                    <th>fullname</th>
                    <th>username</th>
                    <th>password</th>
                    <th>status</th>
                    <th>groupname</th>
                    <th>confirm</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; while ($row = mysqli_fetch_array($data[0])) { ?>
                    <tr>
                        <td scope="row"><?php echo ++$i ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['value'] ?></td>
                        <td class="text-danger"><?php echo $row['groupname'] ?></td>
                        <form action="" method="post">
                        <input type="hidden" name="username" value="<?php echo $row['username'] ?>">

                            <td>
                                <select class="form-select" name="groupname" id="">
                                    <?php   
                                        $data_all = $admin->data_all() ; 
                                        while($row = mysqli_fetch_array($data_all[1])) {
                                    ?>
                                        <option value="<?php echo $row['groupname'] ?>"><?php echo $row['groupname'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name="btn-add-pending" value="Confirm" class="btn btn-outline-primary">
                            </td>
                        </form>
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        
    </div>
</body>
</html>