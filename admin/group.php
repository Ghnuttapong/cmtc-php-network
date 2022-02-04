<?php 

    include 'component/check_admin.php';

    if(isset($_POST['btn-add-group'])) {
        $groupname = $_POST['groupname'];
        $MB = $_POST['MB'];
        $priority = $_POST['priority'];
        $MB *= 1024000;
        $add_group = $admin->add_group($groupname, $MB, $priority);
        if($add_group) {
            header('refresh:0.5;');
        }else {
            echo "Error: SQL";
        }
    }

    if(isset($_POST['btn-del-group'])) {
        $groupname = $_POST['groupname'];
        $del = $admin->del_group($groupname);
        if($del) {
            header('refresh:1;');
        }else {
            echo "Error SQL:";
        }
    }

    $data_all = $admin->data_all();

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
        <h1 class="text-center">Groups</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modelId">
          Add group
        </button>
     
        <!-- main -->
        <hr>
        <div class="row">
            <?php while($result = mysqli_fetch_array($data_all[1])) { ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-capitalize"><?php echo $result['groupname'] ?></h4>
                        <p class="card-text">Internet speed <?php echo $result['value'] / 1024000 ?> MB</p>
                        <form action="" method="post">
                            <a href="edit_group.php?groupname=<?php echo $result['groupname'] ?>" class="btn btn-secondary">Edit</a>
                            <input type="hidden" name="groupname" value="<?php echo $result['groupname'] ?>">
                            <input type="submit" value="Del" name="btn-del-group" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

       
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                      <input required type="text" class="form-control" name="groupname" id="" aria-describedby="helpId" placeholder="Groupname">
                    </div>
                    <div class="mb-3">
                      <input required type="number" max="10" min="1" class="form-control" name="MB" id="" aria-describedby="helpId" placeholder="MB">
                    </div>
                    <div class="mb-3">
                      <input required type="number" max="10" min="1" class="form-control" name="priority" id="" aria-describedby="helpId" placeholder="Priority">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Save" name="btn-add-group" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>