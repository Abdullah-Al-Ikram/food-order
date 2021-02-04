<?php include('../Config/constants.php'); ?>

<html>
<head>
<title>Sign Up</title>
<link rel="stylesheet" href="../CSS/Style.css">
</head>
<body>
    <div class="signin">
    <h1 class="text-center">Sign Up</h1><br>

        <?php 
         if(isset($_SESSION['add']))
         {
             echo $_SESSION['add'];
             unset($_SESSION['add']);
         }
        ?><br>
    
        <form action="" method="POST" class="text-center">
            <table class="text-center">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name..">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="user_name" placeholder="Enter User Name">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr >
                    <td colspan="2"><br><br>
                        <input type="submit" name="submit" value="Sign Up" class="btn-primary">
                    </td>
                </tr>
            </table>
        <br>
        </form>
    <p class="text-center">Created By - <a href="">NPICMT2016-17</a></p>
    </div>
</body>
</html>

<?php 
    if(isset($_POST['submit']))
    {   
        // get Data from form
       $full_name = $_POST['full_name'];
       $user_name = $_POST['user_name'];
       $password = md5($_POST['password']);
        
        // sql query to Save data into database
        $sql = "INSERT INTO tbl_user SET 
        full_name='$full_name',
        user_name='$user_name',
        password='$password' ";
        
        // executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // check whether the data is inserted or not and display message
        if($res==TRUE)
        {
            //echo"data inserted";
            $_SESSION['add'] = "<div class='success'>User Added Successfully.</div>";
            header("location:".SITEURL.'user/signin.php');

        }else{
            //echo"failed to inserted";
            $_SESSION['add'] = "<div class='error'>Failed to Added User.</div>";
            header("location:".SITEURL.'user/signup.php');
        }

    }
?>