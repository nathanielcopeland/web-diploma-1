<?php
session_start();
include("includes/database.php");


$product_query = "SELECT 
products.id,
products.name,
products.description,
products.price,
images.image_file
FROM products 
INNER JOIN products_images 
ON products.id=products_images.product_id
INNER JOIN images
ON images.image_id = products_images.image_id";
$product_statement = $connection->prepare($product_query);
$product_statement->execute();
$result = $product_statement->get_result();


$cat_query = "SELECT category_id,category_name FROM categories";
$cat_statement = $connection->prepare($cat_query);
$cat_statement->execute();
$cat_result = $cat_statement->get_result();
?>
<!doctype html>
<html>
    <?php
    $page_title = "Home Page";
    include("includes/head.php");
    ?>
    <body>
        
        <?php 
        include("includes/navigation.php");
        ?>
        
        
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h3>Categories</h3>
                    <nav>
                        <ul class="nav nav-stacked nav-pills">
                        <?php
                        $cat_selected = 1;
                        if($cat_result->num_rows > 0){
                            while($cat_row = $cat_result->fetch_assoc()){
                            $cat_id = $cat_row['category_id'];
                            $cat_name = $cat_row['category_name'];
                            if($cat_selected==$cat_id){
                                $active = "class='active'";
                            } else {
                                $active = "";
                            }
                            echo "<li $active data-id='$cat_id'>
                            <a href='index.php?category=$cat_id'>$cat_name</a>
                            </li>";
                        }
                        }
                        ?>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <?php
                        if($result->num_rows > 0){
                            $counter = 0;
                            while($row = $result->fetch_assoc()){
                                $counter++;
                                if($counter == 1){
                                    echo "<div class='row'>";
                                }
                                
                                $name = $row['name'];
                                $id = $row['id'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image = $row['image_file'];
                                echo "<div class='col-md-3'>
                                <img class='img-responsive' src='products/$image'>
                                <h3>$name</h3>
                                <h4>$price</h4>
                                <p>$description</p>
                                </div>";
                                
                                if($counter % 4 === 0 ){
                                    echo "</div>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>This is a Footer</h3>
                </div>
                
            </div>
        </div>
        
    </footer>
    
</htm>