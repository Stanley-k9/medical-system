<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values

$user->Name = $_POST['Name'];
$user->Email = $_POST['Email'];
$user->phone = $_POST['phone'];
$user->ID_number = $_POST['ID_number'];


if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "APPOINTMENT SUBMITTED!",
        "id" => $user->id,
        "ID_number" => $user->ID_number
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "ID_number already MADE AN APPOINTMENT FOR THE DAY!"
    );
}
print_r(json_encode($user_arr));
?>