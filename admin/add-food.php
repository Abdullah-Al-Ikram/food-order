<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        
        <?php 
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>

        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Food Title..">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Details of food.."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
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
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>

                                <option value="<?php echo $id;?>"><?php echo $title;?></option>

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
                        <input type="radio" name="featured" value="Yes" > Yes
                        <input type="radio" name="featured" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" > Yes
                        <input type="radio" name="active" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php 

        if(isset($_POST['submit']))
        {
            //echo "clicked";
            //1.get the date from form
            $title =  $_POST['title'];
            $description =  $_POST['description'];
            $price =  $_POST['price'];
            $category = $_POST['category'];
            if(isset($_POST['featured']))
            {
                $featured =  $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
                $active =  $_POST['active'];
            }
            else
            {
                $active = "No";
            }
            //2.upload the image if selected
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
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                    }
                        
                }
            }
            else
            {
                $image_name = "";//setting default value as blank
            }
            //3.insert into database
            $sql2 = "INSERT INTO tbl_food SET 
            title='$title',
            price='$price',
            description='$description',
            image_name='$image_name',
            category_id='$category', 
            featured='$featured', 
            active='$active' 
            ";

            $res2 = mysqli_query($conn, $sql2);
            if($res2==TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                header('location:'.SITEURL.'admin/add-food.php');
            }
                //redirect with  message to manage food 
        }

        ?>

    </div>
</div>
<?php include('partials/footer.php') ?>