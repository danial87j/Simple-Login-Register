<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
     require_once "database.php";
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
     $result = $conn->query($sql);
     
     if ($result->num_rows > 0) {
         header("Location: welcome.php");
     } else {
         echo "Invalid email or password";
     }
   
     ?>     
        <form action="check_login.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="submit">
            </div>
        </form>
    </div>
</body>
</html>