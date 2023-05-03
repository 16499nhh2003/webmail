<?php
require_once('connectDB.php');
class AccountController{
    public function login($us,$pw){
        global $conn;
        $stm = $conn->prepare("select idUser from accountUser where username = ? and password = ?");
        $stm->bind_param("ss",$us,$pw);
        $stm->execute();
        $stm->bind_result($idUser);
        $stm->fetch();
        if(!$idUser){
            return Null;
        }
        else {
            return $idUser;
        }
    }
    public function role($id){
        global $conn;
        $stmt = $conn->prepare("select role from  accountuser where idUser = ?");
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $stmt->bind_result($role);
        $roleUser = $stmt->fetch();
        if(!$roleUser){
            return false;
        }
        else{
            return $role;
        }
    }
    public function block($username){
        global $conn;
        $stmt = $conn->prepare("select blocked from  accountuser where username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->bind_result($role);
        $roleUser = $stmt->fetch();
        if(!$roleUser){
            return false;
        }
        else{
            return $role;
        }
    }
    public function addAccount($username,$password,$idUser){
        global $conn;
        $sql = "SELECT * FROM accountuser where username= '$username'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>0){
            return false;
        }
        else{
            $stmt = $conn->prepare("insert into accountuser(username,password,idUser) values(?,?,?)");
            $stmt->bind_param('ssi', $username, $password,$idUser);
            $stmt->execute();
            if($stmt->affected_rows){
                return true;
            }
            return false;
        }
    }
    public  function delete($a)
    {
        global $conn;
        $result = $conn->query("DELETE from accountuser where  idUser = $a");
        if($result === TRUE){
            return true;
        }
        return false;
    }
    
    public function blockUnBlock($username){
        global $conn;
        $stmt = $conn->prepare("select blocked  from accountuser where username = ?");
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $res = $stmt->get_result();
        $blocked = ($res->fetch_assoc())["blocked"];
        if($blocked === 1){
            $stmt = $conn->prepare("update accountuser set blocked=0 where username = ?");
        }
        else{
            $stmt = $conn->prepare(("update accountuser set blocked = 1 where username = ?"));
        }
        $stmt->bind_param('s',$username);
        $stmt->execute();
        return $conn->affected_rows;
    }
    
    public function changePass($username,$passold,$passsNew){
        global $conn;
        $stmt = $conn->prepare("update accountuser set password = ? where username = ? and password = ?");
        $stmt->bind_param('sss',$passsNew,$username,$passold);
        $stmt->execute();
        return $conn->affected_rows == 1;
    }
    public function fogotPass($username,$passsNew){
        global $conn;
        $stmt = $conn->prepare("update accountuser set password = ? where username = ?");
        $stmt->bind_param('ss',$passsNew,$username);
        $stmt->execute();
        return $conn->affected_rows == 1;
    }
}

class AccountInfo{
    public $username;
    public $password;
    public $idUser;
    public function __construct($username,$password,$idUser)
    {
        $this->username = $username;
        $this->password = $password;
        $this->idUser = $idUser;
    }
}
?>