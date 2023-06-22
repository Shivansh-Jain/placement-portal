<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body background="background.jpg">
<?php
    if ($_SERVER['REQUEST_METHOD'] === "GET"){
    ?>
    <h2 style="text-align: center;padding-top: 1cm;color: white;">Placement Portal</h2>
    <h4 style="text-align: center;padding-top: 1cm;color: white;">Admin login </h4>
    <main class="form-signin w-100 m-auto" style="max-width: 35%;padding-top: 2cm;">
        <form action="admin.php" method="POST">
            <h1 class="h3 mb-3 fw-normal" style="padding-bottom: 0.2cm;color: white;">Please sign in</h1>
            <div class="form-floating" style="padding-bottom:0.1cm ;">
                <input type="email" class="form-control" name="user_id" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating" style="padding-bottom:0.1cm ;">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" style="margin-bottom: 0.1cm;" type="submit">Sign in</button>
        </form>
        <a href="login.html" style="color: white;">Student Login</a>
    </main>
    <?php
    }?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $server = "localhost";
    $username = "root";
    $password = "";
    
        $con = mysqli_connect($server,$username,$password);
        if (!$con){
            die ("connection failed due to ". mysqli_connect_error());
        }
    
    $email = $_POST['user_id'];
    $pswrd = $_POST['password'];
    
    $sql = "SELECT * FROM placement.admin WHERE email = '$email'";
    $result = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($result)>0){
        $user = mysqli_fetch_assoc($result);
            if ($user['password']==$pswrd){
                $sql = "SELECT * FROM placement.students WHERE `Elegible for placement` = 'Yes'";
                $result = mysqli_query($con,$sql);
                if (mysqli_num_rows($result) > 0) {
                    // Fetch the data from the result set
                    echo "<h3 style='text-align: center;color:white;'>Students Eligible For Placements and Internships </h3>";
                    echo "<div class='card px-3 pt-3 m-auto' style='width: 50rem; padding-top: 10%;margin-top: 2cm !important;'>";
                    echo "<ul style='list-style:none;margin: 0;padding: 0;'> ";
                    echo  "
                        <li style='width: 5%;float: left;padding: 2%;'><b>x</b></li> ".
                        "<li style='width: 45%;float: left;padding: 2%;'><b>email</b></li> ".
                         "<li style='width: 25%;float: left;padding: 2%;'><b>name</b> </li> ".
                         "<li style='width: 25%;float: left;padding: 2%;'><b> No. of Diploma Completed </b></li> ";
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Access individual columns using $row['column_name']
                        $index++;
                        echo  "
                        <li style='width: 5%;float: left;padding: 2%;'> ". $index." </li> ".
                        "<li style='width: 45%;float: left;padding: 2%;'> ". $row['email'] ." </li> ".
                         "<li style='width: 25%;float: left;padding: 2%;'> ". $row['name'] ." </li> ".
                         "<li style='width: 25%;float: left;padding: 2%;'> ". $row['No. of Diploma Completed'] ." </li> ";

                    }
                    echo " </ul>";

                    echo "<a href='add' class='m-auto' style='color:blue;'> Add Student </a>";

                    echo "</div><br>";
                } else {
                    echo "No records found.";
                }
    }
            else {
                echo "Invalid credentials";
            }
        
        }
     else {
        echo "no record found please contact support";
    }
    $con->close();
    }
    ?>
</body>
</html>