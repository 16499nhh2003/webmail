<?php
require_once('connectDB.php');
class MailController{
    public function getMailByUserNameAndByType ($username,$type){
        global  $conn;
        $stmt = $conn->prepare("select * from email where username = ? and idFolder = ? ORDER BY thoigian DESC ");
        $stmt->bind_param('si',$username,$type);
        $stmt->execute();
        $stmt->bind_result($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        $mails = [];
        while ($stmt->fetch()){
            $mails[] = new MailInfo($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        }
        return $mails;
    }
    public function getMail($username){
        global  $conn;
        $stmt = $conn->prepare("select * from email where username = ?  ORDER BY thoigian DESC ");
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $stmt->bind_result($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        $mails = [];
        while ($stmt->fetch()){
            $mails[] = new MailInfo($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        }
        return $mails;
    }
    
    public function sendReceiveMail($chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username){
        global $conn;
        $stmt = $conn->prepare("INSERT INTO `email`(`chude`, `noidung`, `nguoigui`, `thoigian`, `starred`, `read`, `idFolder`, `username`) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssiiis',$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        $stmt->execute();
        if($stmt->affected_rows){
            return $stmt->insert_id;
        }
        return -1;
    }
    public function findUserNameByEmail($email){
        global $conn;
        $stmt = $conn->prepare("select username from accountuser join users on accountuser.idUser = users.id  where users.email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();
        $result = $username;
        return $result;
    }
    public function findMailByUserName($username){
        global $conn;
        $stmt = $conn->prepare("select email from accountuser join users on accountuser.idUser = users.id  where accountuser.username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->fetch();
        $result = $email;
        return $result;
    }
    public function deleteMail($id){
        global $conn;
        $stmt = $conn->prepare("update email set idFolder = 3 where id = ? ");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        if ($stmt->affected_rows){
            return true;
        }
        return false ;
    }

    public function delete($id){
        global $conn;
        $stmt = $conn->prepare("delete from email where id = ? ");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        if ($stmt->affected_rows){
            return true;
        }
        return false ;
    }
    public function updateStarred($id){
        global $conn;
        $stmt = $conn->prepare("select starred  from email where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $res = $stmt->get_result();
        $blocked = ($res->fetch_assoc())["starred"];
        if($blocked === 1){
            $stmt = $conn->prepare("update email set starred = 0 where id = ? ");
        }
        else{
            $stmt = $conn->prepare("update email set starred = 1 where id = ? ");
        }
        $stmt->bind_param('s',$id);
        $stmt->execute();
        return $conn->affected_rows;
    }
    public function updateRead($id){
        global $conn;
        $stmt = $conn->prepare("select `read` from email where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $res = $stmt->get_result();
        $blocked = ($res->fetch_assoc())["read"];
        if($blocked === 1){
            $stmt = $conn->prepare("update email set `read` = 0 where id = ? ");
        }
        else{
            $stmt = $conn->prepare("update email set `read` = 1 where id = ? ");
        }
        $stmt->bind_param('s',$id);
        $stmt->execute();
        return $conn->affected_rows;
    }
    public function Read($id){
        global $conn;
        $stmt = $conn->prepare("select `read` from email where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $res = $stmt->get_result();
        $blocked = ($res->fetch_assoc())["read"];
        $stmt = $conn->prepare("update email set `read` = 1 where id = ? ");
        $stmt->bind_param('s',$id);
        $stmt->execute();
        return $conn->affected_rows;
    }
    public function getMailImportant($username){
        global  $conn;
        $stmt = $conn->prepare("select * from email where username = ? and starred = 1 ORDER BY thoigian DESC ");
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $stmt->bind_result($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        $mails = [];
        while ($stmt->fetch()){
            $mails[] = new MailInfo($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username);
        }
        return $mails;
    }
}
class MailInfo{
    public $id;
    public $chude;
    public $noidung;
    public $nguoigui;
    public $starred;
    public $thoigian;
    public $read;
    public $idFolder;
    public $username;
    public function __construct($id,$chude,$noidung,$nguoigui,$thoigian,$starred,$read,$idFolder,$username)
    {
        $this->id = $id;
        $this->chude = $chude;
        $this->noidung = $noidung;
        $this->nguoigui = $nguoigui;
        $this->starred = $starred;
        $this->thoigian = $thoigian;
        $this->read = $read;
        $this->idFolder = $idFolder;
        $this->username = $username;
    }
}
?>