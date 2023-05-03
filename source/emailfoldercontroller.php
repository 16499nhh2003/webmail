<?php
require_once('connectDB.php');
class EmailFolderController{
    public function addFoderImportant($idEmail,$idFolder){
        global $conn;
        $stmt = $conn->prepare("INSERT INTO `email_folder`(`idEmail`, `idFolder`) VALUES (?,?)");
        $stmt->bind_param('ii',$idEmail,$idFolder);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function deleteFoderImportant($idEmail)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM `email_folder` WHERE idEmail = ? and idFolder = 6 ");
        $stmt->bind_param('i',$idEmail);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    // public function getAllFoderImportant()
    // {
    //     global $conn;
    //     $stmt = $conn->prepare("SELECT `idEmail`, `idFolder` FROM `email_folder` WHERE ")
    // }
}
?>