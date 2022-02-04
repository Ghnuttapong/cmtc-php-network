<?php 
    
    include 'component/check_admin.php';
    $data_all = $admin->data_all();

    if(isset($_POST['btn-del-user'])) {
        $username = $_POST['username'];
        $del_user = $admin->del_user($username);
        if($del_user) {
            header('refresh:0.5;');
        }else {
            echo "Error SQL del_user";
        }
    }

    if(isset($_POST['btn-block-user'])) {
        $username = $_POST['username'];
        $block_user = $admin->block_user($username);
        if($block_user) {
            header("refresh:0.5;");
        }else {
            echo "Error SQL block_user";
        }
    }

    if(isset($_POST['btn-unblock-user'])) {
        $username = $_POST['username'];
        $block_user = $admin->unblock_user($username);
        if($block_user) {
            header("refresh:0.5;");
        }else {
            echo "Error SQL unblock_user";
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
        <h1 class="text-center">Users</h1>
        <hr>
        <table class="table table-striped table-hover table-inverse table-responsive">
            <thead class="thead-inverse text-capitalize text-center">
                <tr>
                    <th>#</th>
                    <th>fullname</th>
                    <th>username</th>
                    <th>password</th>
                    <th>group</th>
                    <th>view/edit/del</th>
                    <th>status block</th>
                    <th>block</th>
                </tr>
                </thead>
                <tbody class="text-center" >
                    <?php $i=0; while($row = mysqli_fetch_array($data_all[0])) { ?>
                    <tr>
                        <td scope="row"><?php echo ++$i ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['value'] ?></td>
                        <td>
                            <?php if($row['groupname'] == "pending") { ?>
                                <p class="text-danger"><?php echo $row['groupname'] ?></p>
                            <?php } else { ?>
                                <p class="text-muted"><?php echo $row['groupname'] ?></p>
                            <?php } ?>
                        </td>
                        <form action="" method="post">
                            <td>
                                <a class="btn btn-outline-primary" href="view_user.php?username=<?php echo $row['username'] ?>" >View</a>
                                <a class="btn btn-outline-secondary" href="edit_user.php?username=<?php echo $row['username'] ?>" >Edit</a>
                                <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                                <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete <?php echo $row['username'] ?>')" name="btn-del-user" value="Del">
                            </td>
                        </form>
                            <?php if($row['attribute'] != "Cleartext-Password") { ?>
                                <td>
                                    <p class="text-success">true</p>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                                        <input type="submit" class="btn btn-outline-success" value="Unblock" name="btn-unblock-user">
                                    </form>
                                </td>
                                <?php } else { ?>
                                    <td>
                                        <p class="text-danger">false</p>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                                            <input type="submit" class="btn btn-warning" value="Block" name="btn-block-user">
                                        </form>
                                    </td>
                            <?php } ?>
                        
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        
    </div>
</body>
</html>