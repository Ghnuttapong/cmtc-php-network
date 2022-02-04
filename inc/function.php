<?php 

    class dbcon {
        function __construct()
        {
            $conn = new mysqli("localhost", "skill", "1234", "radius") or die("Error Connect:").mysqli_connect_error();

            $this->dbcon = $conn;
            
        }

        public function check_register($username) {
            $sql = mysqli_query($this->dbcon, "SELECT * FROM radcheck WHERE username = '$username' ");
            return $sql;
        }

        public function user_register($username, $password, $fullname) {
            $sql1 = mysqli_query($this->dbcon, "INSERT INTO radcheck(username, value, fullname) VALUE ('$username', '$password', '$fullname') ");
            $sql2 = mysqli_query($this->dbcon, "INSERT INTO usergroup(username, groupname, priority) VALUE ('$username', 'pending', 1)");
            return array( $sql1, $sql2);
    
        }

        public function check_login($username, $password) {
            $sql1 = mysqli_query($this->dbcon, "SELECT * FROM radcheck  WHERE username = '$username' AND value = '$password' ");
            $sql2 = mysqli_query($this->dbcon, "SELECT * FROM  usergroup WHERE username = '$username' ");
            return array($sql1, $sql2);
        }

        /* admin page admin/group */
        public function add_group($groupname, $MB, $priority) {
            $sql1 = mysqli_query($this->dbcon, "INSERT INTO radgroupcheck(groupname, attribute, op, value) VALUE ('$groupname', 'Auth-Type', ':=', 'Local' )");
            $sql2 = mysqli_query($this->dbcon, "INSERT INTO radgroupreply(groupname, attribute, op, value) VALUE ('$groupname', 'WISPr-Bandwidth-Max-Down', ':=', '$MB' ) ");
            return array($sql1, $sql2);
        }

        public function del_group($groupname) {
            $sql1 = mysqli_query($this->dbcon, "DELETE FROM radgroupcheck WHERE groupname = '$groupname' ");
            $sql2 = mysqli_query($this->dbcon, "DELETE FROM radgroupreply WHERE groupname = '$groupname' ");
            return $sql1;
        }
        
        public function data_all () {
            // user
            $sql1 = mysqli_query($this->dbcon, "SELECT radcheck.*, usergroup.* FROM radcheck INNER JOIN usergroup ON radcheck.username = usergroup.username");
            // group
            $sql2 = mysqli_query($this->dbcon, "SELECT radgroupcheck.* , radgroupreply.* FROM radgroupcheck INNER JOIN radgroupreply ON radgroupcheck.groupname = radgroupreply.groupname ");
            return array($sql1, $sql2);
        }

        public function data($data_data) {
            // get data in groupname
            $sql1 = mysqli_query($this->dbcon, "SELECT radcheck.*, usergroup.* FROM radcheck INNER JOIN usergroup ON radcheck.username = usergroup.username WHERE usergroup.groupname = '$data_data' ");
            $sql2 = mysqli_query($this->dbcon, "SELECT * FROM radgroupreply WHERE groupname = '$data_data' ");
            
            $sql3 = mysqli_query($this->dbcon, "SELECT radcheck.*, usergroup.* FROM radcheck INNER JOIN usergroup ON radcheck.username = usergroup.username WHERE usergroup.username = '$data_data' ");
            return array($sql1, $sql2, $sql3);
        }

        public function add_pending($groupname, $username, $value) {
            $sql1 = mysqli_query($this->dbcon, "UPDATE usergroup SET groupname = '$groupname' WHERE username = '$username' ");
            $sql2 = mysqli_query($this->dbcon, "INSERT INTO radreply(username, attribute, op, value) VALUE ('$username', 'WISPr-Bandwidth-Max-Down', ':=', '$value' )");

            return array($sql1, $sql2);
        }

        public function del_user($username) {
            $sql1 = mysqli_query($this->dbcon, "DELETE FROM radcheck WHERE username = '$username' ");
            $sql2 = mysqli_query($this->dbcon, "DELETE FROM usergroup WHERE username = '$username' ");
            $sql3 = mysqli_query($this->dbcon, "DELETE FROM radreply WHERE username = '$username' ");
            return array($sql1, $sql2, $sql3);
        }

        public function block_user($username) {
            $sql = mysqli_query($this->dbcon, "UPDATE radcheck SET attribute = '' , op = '==' WHERE username = '$username' ");
            return $sql;
        }

        public function unblock_user($username) {
            $sql = mysqli_query($this->dbcon, "UPDATE radcheck SET attribute = 'Cleartext-Password' , op = ':=' WHERE username = '$username' ");
            return $sql;
        }

        public function register_by_admin($fullname, $username, $password, $groupname, $value) {
            $sql1 = mysqli_query($this->dbcon, "INSERT INTO radcheck(username, op, value, fullname) VALUE ('$username', ':=', '$password', '$fullname')");
            $sql2 = mysqli_query($this->dbcon, "INSERT INTO usergroup(username, groupname, priority) VALUE ('$username', '$groupname', 1)");
            $sql3 = mysqli_query($this->dbcon, "INSERT INTO radreply(username, attribute, op, value) VALUE('$username', 'WISPr-Bandwidth-Max-Down', ':=', '$value' ) ");
            return array($sql1, $sql2, $sql3);
        }

        public function change_profile($fullname, $username, $new_password) {
            $sql = mysqli_query($this->dbcon, "UPDATE radcheck SET fullname = '$fullname', value = '$new_password' WHERE username = '$username' ");
            return $sql;
        }

        public function change_profile_user($fullname, $username,  $new_password, $groupname, $value) {
            $sql1 = mysqli_query($this->dbcon, "UPDATE radcheck SET fullname = '$fullname', value = '$new_password' WHERE username = '$username' ");
            $sql2 = mysqli_query($this->dbcon, "UPDATE usergroup SET groupname = '$groupname' WHERE username = '$username' ");
            $sql3 = mysqli_query($this->dbcon, "UPDATE radreply SET value = '$value' WHERE username = '$username' ");
            return array($sql1,$sql2, $sql3);
        }

        public  function radacct_check() {
            $sql = mysqli_query($this->dbcon, "SELECT * FROM radacct WHERE `acctsessiontime` = 0 ");
            return $sql;
        }
        public  function radacct_check_user($username) {
            $sql1 = mysqli_query($this->dbcon, "SELECT * FROM radacct WHERE username = '$username' ");
            return $sql1;
        }

        public function sum_acctime($username) {
            $sql = mysqli_query($this->dbcon, "SELECT SUM(acctsessiontime), SUM(acctinputoctets), SUM(acctoutputoctets) FROM radacct WHERE username = '$username' ");
            return $sql;
        }

        public function change_group($groupname, $value, $old_gorupname) {
            $sql1 = mysqli_query($this->dbcon, "UPDATE radgroupcheck SET groupname = '$groupname' WHERE groupname = '$old_gorupname' ");
            $sql2 = mysqli_query($this->dbcon, "UPDATE radgroupreply SET groupname = '$groupname', value = '$value' WHERE groupname = '$old_gorupname'  ");
            $sql3 = mysqli_query($this->dbcon, "UPDATE usergroup SET groupname = '$groupname' WHERE groupname = '$old_gorupname' ");
            return array($sql1, $sql2);
        }
    }
?>