<?php include('partials/navbar.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>

        <?php

            // to check whether the id is set or not
            if (isset($_GET['id']) AND isset($_GET['image_name']))
            {
                // GET the ID and all the other details
                $id = $_GET['id'];
                
                // execute SQL Query to get all the details
                $sql = "SELECT * FROM tbl_category WHERE id =$id";

                // execute the query
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count == 1)
                {
                    //echo "Row fetched";
                    // GET the data 

                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $curr_img = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else 
                {
                    // echo 'not';
                    // redirect to manage-category.php

                    $_SESSION['no-category-found'] = '<div class="error">Category Not Found!</div>';

                    header('location:'.SETURL.'admin/manage-category.php');
                }
            }
            else 
            {
                // redirect to manage category
                header('location:'.SETURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method='POST' enctype='multipart/form-data'>
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name ="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <input type="file">
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <button type='submit' name='submit' class='btn-secondary'>Update Category</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php')?>