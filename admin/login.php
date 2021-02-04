
<?php include('../Config/constants.php'); ?>

<html>
<head>
<title>login - Food Order System</title>
<link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <div class="login">
    <h1 class="text-center">Login</h1><br>

        <?php 
         if(isset($_SESSION['login']))
         {
             echo $_SESSION['login'];
             unset($_SESSION['login']);
         }
         if(isset($_SESSION['no-login-message']))
         {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
         }
        ?><br>
    
        <form action="" method="POST" class="text-center">
        User Name: <br>
        <input type="text" name="user_name" placeholder="Enter User Name"> <br><br>
        Password: <br>
        <input type="password" name="password" placeholder="Enter Password"> <br> <br>
        <input type="submit" name="submit" value="Login" class="btn-primary">
        </form><br>
    <p class="text-center">Created By - <a href="">NPICMT2016-17</a></p>
    </div>
</body>
</html>

<?php 
if(isset($_POST['submit']))
{
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE user_name='$user_name' AND password='$password'";
    
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
        $_SESSION['user'] = $user_name;
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>Incorrect User Name and Password.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
}
?>