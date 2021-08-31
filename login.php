<?php
    // database connection

    $userError = '';
    $passError = '';

    $commonError = '';

    $db = mysqli_connect ( "localhost", "root", "", "onlinebookshop" ) or die("unable to connect");

    if(isset($_POST['submit'])){
        $nameq = $_POST['username'];
        $pass = $_POST['userpass'];
        if(empty($nameq)){
            $userError= 'username is required';
        } if(empty($pass)){
            $passError = 'password is required';
        } else{
            $sql = "SELECT * FROM usersb WHERE `email` ='$nameq'";
            $userInfo = mysqli_query($db, $sql);

            $row = mysqli_fetch_array($userInfo);

            if($row == null){
                $commonError = 'User Not found!!';
                
            } else{
                $checkPass = strcmp($row['password'],$pass);
                if($checkPass === 0){
                    header('location: home.php');
                } else{
                    $commonError = 'Incorect Password!! try again...';
                    
                }
            }
        }

    }
    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>

    <style>
        .dataForm{
            display: none;
        }
        p{
            color: red;
        }
    </style>
</head>
<body  style="background-color: rgb(34, 168, 168);">
    <div class="container" style="text-align: center;">
    <div class="jumbotron" style="margin-top: 300px;text-align: center;">
            <h1 style="color: blue; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">LOGIN PAGE</h1> 
                <form  method="POST" action="" id='form'>
                    <label for="name"><strong>Username:</strong></label>: 
                    <input type="text" id="name" name='username' ><br>
                        <p><?php echo $userError ?></p>

                    <label for="studentid"><strong>Password:</strong></label>: 
                    <input type="text" id="studentid" name="userpass" ><br>
                        <p><?php echo $passError ?></p>
                        <p><?php echo $commonError ?></p>

                <input class="btn btn-outline-info" type="submit" value="Login" name="submit">
            </form>      
        </div> 
 </div>

   

</body>
</html>