
<?php include('../Config/constants.php'); ?>

<html>
<head>
<title>Signin</title>
<link rel="stylesheet" href="../CSS/Style.css">
</head>
<body>
    <div class="signin">
    <h1 class="text-center">Signin</h1><br>

        <?php 
         if(isset($_SESSION['signin']))
         {
             echo $_SESSION['signin'];
             unset($_SESSION['signin']);
         }
        ?><br>
    
        <form action="" method="POST" class="text-center">
        User Name: <br>
        <input type="text" name="user_name" placeholder="Enter User Name"> <br><br>
        Password: <br>
        <input type="password" name="password" placeholder="Enter Password"> <br> <br>
        <input type="submit" name="submit" value="Sign In" class="btn-primary">
        <br><br>
        <p class="text-center"><a href="<?php echo SITEURL;?>user/signup.php">Sign Up</a></p>
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

    $sql = "SELECT * FROM tbl_user WHERE user_name='$user_name' AND password='$password'";
    
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $_SESSION['signin'] = "<div class='success'>Sign In Successfully.</div>";
        $_SESSION['user'] = $user_name;
        header('location:'.SITEURL);
    }
    else
    {
        $_SESSION['signin'] = "<div class='error text-center'>Incorrect User Name and Password.</div>";
        header('location:'.SITEURL.'user/signin.php');
    }
}
?>