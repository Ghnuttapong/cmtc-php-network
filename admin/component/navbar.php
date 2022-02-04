<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand text-uppercase" href="./"><?php echo $_SESSION['username'] ?></a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0 text-capitalize">
            <li class="nav-item active">
                <a class="nav-link" href="./">Home <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./pending.php">pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./user.php">user</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./add_user.php">Add user</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./group.php">group</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'] ?></a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="profile.php">profile</a>
                    <a class="dropdown-item" href="../logout.php">logout</a>
                </div>
            </li>
        </ul>
    </div>
    </div>
</nav>