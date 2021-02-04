<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1> <br> <br>

        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_food  WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);
            if($count==1)
            {
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            }
            else
            {
                $_SESSION['no-food-found'] = "<div class='error'>Food Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>" placeholder="Enter Food Title..">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Details of food.."><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!="")
                        {
                            ?>

                            <img src="<?php echo SITEURL; ?>Images/Food/<?php echo $current_image;?>" width="100px" >

                            <?php
                        }
                        else
                        {
                            echo "<div class='error'> Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                        <?php 
                        //create php code to display category from data base
                        //1. create sql to get all active category from database
                        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";
                        //excuting query
                        $res = mysqli_query($conn, $sql);
                        
                        //count rows to check whether we have category or not 
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_id = $row['id'];
                                $category_title = $row['title'];
                                ?>

                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>

                                <?php
                            }
                        }
                        else
                        {
                            ?>

                            <option value="0">No Category Found.</option>

                            <?php
                        }

                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes" > Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes" > Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    if($image_name!="")
                    {
                        //rename the image
                        $ext = end(explode('.',$image_name));
                        //create new name
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../Images/Food/".$image_name;
                        $upload = move_uploaded_file($src, $dst);
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload New Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            die();
                        }
                        if($current_image!="")
                        {
                            $remove_path = "../Images/Food/".$current_image;

                            $remove = unlink($remove_path);
                            if($remove==FALSE)
                            {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image. </div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                

                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                }
                else
                {
                    $image_name = $current_image;
                }
                $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);
                if($res3==TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>