<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
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
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>



<?php 
    if(isset($_POST['submit']))
    {   
        // get Data from form
       $full_name = $_POST['full_name'];
       $user_name = $_POST['user_name'];
       $password = md5($_POST['password']);
        
        // sql query to Save data into database
        $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        user_name='$user_name',
        password='$password' ";
        
        // executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // check whether the data is inserted or not and display message
        if($res==TRUE)
        {
            //echo"data inserted";
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');

        }else{
            //echo"failed to inserted";
            $_SESSION['add'] = "<div class='error'>Failed to Added Admin.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    }
?>