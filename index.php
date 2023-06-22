<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
$server = "localhost";
$username = "root";
$password = "";

    $con = mysqli_connect($server,$username,$password);
    if (!$con){
        die ("connection failed due to ". mysqli_connect_error());
    }

$email = $_POST['user_id'];


$sql = "SELECT * FROM placement.students WHERE email = '$email'";
$result = mysqli_query($con,$sql);

if (mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
        if ($user['Elegible for placement'] == 'YES'){
        echo "Congratulations ".$user['name']." you are eligible for placements more details will be updated shortly <br>";
        }
        else {
            echo "You have to complete atleast one diploma to sit for placements";
        }
    //     if ($user['password']==$pswrd){
    //         echo "Welcome ".$email."your details will be updated shortly <br>";
    //     }
    //     else {
    //         echo "Invalid credentials";
    //     }
    // }
   
} else {
    echo "no record found please contact support";
}




?>
</body>
</html>