<?php 
    require 'check_user.php';

    $username = $_SESSION['username'];
    $data = $user->radacct_check_user($username);
    $data2 = $user->sum_acctime($username);
    $fetch = mysqli_fetch_array($data2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <?php require 'style.php' ?>
</head>
<body>
    <div class="bg-light container mt-5 p-5 text-capitalize">
        <div class="text-center my-3">
            <a href="../logout.php" class="btn btn-outline-danger">logout</a>
            <a href="profile.php" class="btn btn-outline-warning">profile</a>
        </div>
        <div class="text-center">
            <b>History</b> || <span>Username :<?php echo $username; ?></span>
            <p>จำนวนเวลาที่ใช้ทั้งหมด: <?php echo number_format($fetch[0]/360, 2)?> ชม. Download ทั้งหมด: <?php echo number_format($fetch[2]/1024000, 2)?> Mbps Upload ทั้งหมด: <?php echo number_format($fetch[1]/1024000, 2)?> Mbps </p>
        </div>
        <table class="table table-striped table-hover table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>เริ่มใช้งาน</th>
                    <th>สิ้นสุดการใช้งาน</th>
                    <th>ใช้เวลาทั้งหมด</th>
                    <th>Download</th>
                    <th>Upload</th>
                    <th>IP</th>
                </tr>
                </thead>
               <tbody>
                    <?php $i = 0; while($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {?>
                        <tr>
                            <td scope="row"><?php echo ++$i ?></td>
                            <td scope="row"><?php echo $row['acctstarttime'] ?></td>
                            <td scope="row"><?php echo $row['acctstoptime'] ?></td>
                            <td scope="row"><?php echo number_format($row['acctsessiontime'] / 60,2) ?></td>
                            <td scope="row"><?php echo number_format( $row['acctoutputoctets'] / 1024000, 2) ?>Mbps</td>
                            <td scope="row"><?php echo number_format($row['acctinputoctets'] / 1024000, 2) ?>Mbps</td>
                            <td><?php echo $row['framedipaddress'] ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
        </table>
        
    </div>
</body>
</html>