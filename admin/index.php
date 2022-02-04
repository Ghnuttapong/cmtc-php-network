<?php 

    include 'component/check_admin.php';
    $radacct = $admin->radacct_check();

    if(isset($_POST['btn-kickoff'])) {
        $username = $_POST['username'];
        $ip = $_POST['ip'];
        $ip = substr($ip, 5,1);
        if($ip == 1) {
            $ipaddress = 79;
        }else {
            $ipaddress = 80;
        }

	$disconnect = '/bin/echo User-Name='.$_POST['username'].' | /usr/bin/radclient -x 127.0.0.1:3779 disconnect testing123 ';
	$shell_command=$disconnect;
	$output = shell_exec($disconnect);
        if($disconnect) {
            echo "<script>alert('Kickoff user $username successful')</script>";
            header('refresh:1;');
        }else {
            echo "<script>alert('Kickoff user $username failed')</script>";
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
        <h1 class="text-center">Active</h1>
        <hr>
        <table class="table table-striped table-hover table-inverse table-responsive">
            <thead class="thead-inverse text-capitalize">
                <tr>
                    <th>#</th>
                    <th>username</th>
                    <th>groups</th>
                    <th>status</th>
                    <th>kickoff</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; while($row = mysqli_fetch_array($radacct)) {?>
                    <tr>
                        <td scope="row"><?php echo ++$i ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['groupname'] ?></td>
                        <td><p class="text-success">True</p></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                                <input type="hidden" name="ip" value="<?php echo $row['framedipaddress'] ?>">
                                <input type="submit" value="Kickoff" class="btn btn-outline-danger" name="btn-kickoff">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        
    </div>
</body>
</html>
