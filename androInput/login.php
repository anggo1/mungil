<?php

if(isset($_POST['email']) && isset($_POST['password'])){
    require_once "conn.php";
    require_once "validate.php";
    $data=array();
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $query=mysqli_query($conn,"SELECT* FROM user LEFT JOIN pangkalan ON pangkalan.id=user.lokasi WHERE user.UserName='$email' and user.password='" . md5($password) . "'");
    $cek=mysqli_num_rows($query);

    if($cek > 0){
    $data=array();  
        foreach ($query as $query):
        $data=array('success','nama'=>$query['FirstName'],'lokasi'=>$query['pangkalan']);
    endforeach;

    echo json_encode($data);
    } else {
       $data= array('Salah','nama'=>'0','lokasi'=>'0');
       echo json_encode($data);
    }
}
?>