<?php

@include 'config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass=md5($_POST['password']); 
    $cpass=md5($_POST['cpassword']);
    $user_type=$_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){;
    $error[] = 'user already exists';

    }else{
        
        if($pass != $cpass){
            $error[] = 'password not matched!';
    }else{
        $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
        mysqli_query($conn, $insert);
        header('location:login.php');
    }
}
};
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="backend.css">
</head>
<body>
    
       
    


    <section class="header">
        <nav>
            <a href="../Home.php"><img src="../img/logo.PNG"></a>
            <div class="nav-links">
                <ul>
                    <li><a href="../Home.php">Home</a></li>
                    <li><a href="../about.php">About</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </div>
        </nav>

        <div class = "form-container">
                <form action="" method="post">
                <h3>Register</h3>
                <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo'<span class ="error-msg">'.$error.'</span>';
                    }
                }
                ?>
                <input type = "text" name="name" required placeholder="Name">
                <input type = "email" name="email" required placeholder="Email">
                <input type = "passwprd" name="password" required placeholder="Password">
                <input type = "passwprd" name="cpassword" required placeholder="Confirm Password">
                <select name="user_type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <input type = "submit" name="submit" value="Register" class="form-btn">
                <p>Already have an account <a href="login.php">Login Now</a></p>
            </form>
        </div>
    </section>

    
</body>
</html>