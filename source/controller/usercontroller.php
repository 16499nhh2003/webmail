<?php
require_once('connectDB.php');
class UserController{
    public function addUser($fullname,$dob,$gioitinh,$email){
        global $conn;
        $sql = "SELECT * FROM USERS where email = '$email' ";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>0){
            return -1;
        }
        else{
            $stmt = $conn->prepare("insert into users(fullname,dob,gioitinh,email) values(?,?,?,?)");
            $stmt->bind_param('ssis', $fullname, $dob, $gioitinh, $email);
            $stmt->execute();
            if($stmt->affected_rows){
                return $stmt->insert_id;
            }
            return -1;
        }
    }
    public function getAllUser(){
        global $conn;
        $stmt =  $conn->prepare("SELECT id, fullname, dob, email, gioitinh ,username , blocked ,ngayTao FROM `users` join `accountuser` on users.id = accountuser.idUser");
        $stmt->execute();
        $stmt->bind_result($id,$fullname,$dob,$email,$gioitinh,$username,$blocked,$ngayLap);
        $users = [];
        while($stmt->fetch()){
            $users[] = array('id'=>$id,'fullname'=>$fullname,'dob'=>$dob,'email'=>$email,'gioitinh'=>$gioitinh,'username'=>$username,'blocked'=>$blocked,'ngaylap'=>$ngayLap);
        }
        return $users;
    }

    public function getUserById($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT fullname, dob, email, gioitinh from `users` where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->bind_result($fullname,$dob,$email,$gioitinh);
        $stmt->fetch();
        if(!$fullname){
            return Null;
        }
        else{
            return new UserInfo($id,$fullname,$dob,$gioitinh,$email);
        }
    }

    public  function delete($a)
    {
        global $conn;
        $result = $conn->query("DELETE from users where id = $a");
        if($result === TRUE){
            return true;
        }
        return false;
    }
    public function update($id,$fullname,$dob,$gioitinh,$email){
        global $conn;
        $stmt = $conn->prepare("update users set fullname = ? , dob = ? , gioitinh = ? , email = ? where id = ?");
        $stmt->bind_param('ssisi',$fullname,$dob,$gioitinh,$email,$id);
        $result = $stmt->execute();
        if($result){
            return true;            
        }
        return false;
    }
}
class UserInfo{
    public $id;
    public $fullname;
    public $dob;
    public $gioitinh;
    public $email;
    public function __construct($id,$fullname,$dob,$gioitinh,$email)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->dob = $dob;
        $this->gioitinh = $gioitinh;
        $this->email = $email;
    }
}
?>