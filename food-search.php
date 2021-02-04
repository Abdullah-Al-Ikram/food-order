<?php include('partials-front/menu.php');?>

    <section class="food-search text-center">
        <div class="container">
            <?php
                $search = $_POST['search'];
            ?>
            <h2>Foods on Your Search <a href="#" class="text-col"><?php echo $search;?></a></h2>
        </div>
    </section>

    <!--Food Menu-->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menus</h2>

            <?php

            $search = $_POST['search'];
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
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
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail"><?php echo $description;?></p> <br>
                                <a href="<?php echo SITEURL;?>order.php" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                }
            }
            else
            {
                echo "<div class='erroe'>Food not found.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

    <?php include('partials-front/footer.php');?>