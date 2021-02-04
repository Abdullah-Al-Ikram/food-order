<?php include('partials-front/menu.php');?>

    <!--Search-->

    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search For Food..">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>

    <?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    if(isset($_SESSION['signin']))
    {
        echo $_SESSION['signin'];
        unset($_SESSION['signin']);
    }
    ?>
    <!--Categories-->

    <section class="categories">
        <div class="container">
            <h2 class="text-center ">Foods Category</h2>

            <?php
            //sql query to display categories from date
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //excuting query
            $res = mysqli_query($conn, $sql);
            //counting rows from database
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    

                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php 
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image Not Found.</div>";
                            }
                            else
                            {
                                ?>
                                
                                <img src="<?php echo SITEURL;?>Images/Category/<?php echo $image_name; ?>" alt="pizza" class="img-responsive img-curve">

                                <?php
                            }
                            ?>
                            <h3 class="float-text text-col"><?php echo $title;?></h3>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Category not added.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

    <!--Food menu-->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menus</h2>

            <?php
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="Efood-menu">
                        <div class="food-menu-img">
                            <?php 
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image Not Found.</div>";
                            }
                            else
                            { 
                            ?>
                                <img src="<?php echo SITEURL;?>/Images/Food/<?php echo $image_name;?>" alt="Chicken Italian Pizza" class="img-responsive img-curve">
                            <?php
                            }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo  "$".$price ;?></p>
                        <p class="food-detail"><?php echo $description; ?></p> <br>
                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                    <?php
                }
            }
            else
            {
               echo "<div class='error'>Food Not Added.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
<?php include('partials-front/footer.php');?>