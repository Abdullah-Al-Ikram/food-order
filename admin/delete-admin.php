<?php 
    include('../Config/constants.php');
    // get id of admin to delete
    $id = $_GET['id'];
    // create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //excute the query
    $res = mysqli_query($conn, $sql);
    if($res==TRUE)
    {
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>