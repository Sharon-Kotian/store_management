           <div class="col-md-4">

           <?php

//           include "includes/db.php";


/*            if(isset($_POST['submit']))
            {
                $search = $_POST['search'];

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                $search_query = mysqli_query($connection,$query);

                if(!$search_query)
                {
                    die("Query Failed" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($search_query);

                if($count==0)
                {
                    echo "<h1>No Result Found</h1>";
                }
                else
                {
                    while($row = mysqli_fetch_assoc($search_query))
                    {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    }
            }
*/
           ?>




                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit"  class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

        
                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="POST">
                    <div class="form-group">
                        <input name="username" placeholder="Enter Username" type="text" class="form-control">
                    </div>
                    <div class="input-group">
                        <input name="password" placeholder="Enter Password" type="password" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Submit
                            </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>









                <!-- Blog Categories Well -->
                <div class="well">

                <?php
                    $query = "SELECT * FROM category";
                    $select_categories_sidebar = mysqli_query($connection,$query);
                ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                    <?php

                        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) 
                        {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];

                            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                        }
                    ?>

                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                    <?php include "widget.php";?>
            </div>
