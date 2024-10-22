<?php
include 'dbconn.php';
include 'header.php';
?>
<div class="main-container">
    <hr style="color: darkgreen;margin-left:auto; width:98.5%">

    <div class="box1">
        <div class="subtitle-div">
            <label id="subtitle">Users profile </label>
        </div>
        <form action="" method="GET">
            <div class="search-div">
                <input type="text" name="search_bar" id="search-bar"
                    placeholder="Search profile . . ."
                    value="<?php if (isset($_GET['search_bar'])) {
                                $search_bar = $_GET['search_bar'];
                            } ?>">
                <input type="submit" name="search-btn" value="Search"
                    id="search-btn" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#searchModal">
                <!-- <i class="fa fa-search" style="color: black;"></i> -->
            </div>
        </form>
    </div>

    <?php
    if (isset($_GET['search_bar'])) {
        $search_bar = $_GET['search_bar'];
        $query = "SELECT * FROM profile WHERE CONCAT(name,contact) LIKE '%$search_bar%' ";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
                echo '<hr style="color:darkgreen;width:98.5%;margin-left:auto;"><center><div class="msg" style="width: 95%;background-color:green;padding:8px;margin:auto;">';
                echo '<input type="submit" name="search-btn" value="View Result"
                    id="view_result" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#searchModal">';
                echo '</div></center>';
            foreach($result as $row){
                ?>
    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #363232;">Search result</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hovered table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>
                                    <center>
                                        <label id="action-search" style="font-size: 1rem;color:black">Action</label>
                                    </center>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                                    <tr>
                                        <td id="image-div">
                                            <a href="update_image.php?id=<?php echo $row['id'] ?>" class="fa-solid fa-pen-to-square" id="pen"></a>
                                            <img src="sample/<?php echo $row['image'] ?>">
                                        </td>
                                        <td id="name_div"><?php echo $row['name'] ?></td>
                                        <td id="contact_div"><?php echo $row['contact'] ?></td>

                                        <td id="action-div">
                                            <div class="action">
                                                <a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-success" id="edit-btn">Edit</a>
                                                <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" id="delete-btn">X</a>
                                            </div>
                                        </td>
                                    </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="index_admin.php" class="btn btn-danger">Close</a>
                </div>
            </div>
        </div>
    </div>    
    <?php            
            
        }
        else{
            echo '<hr style="color:darkgreen;width:98.5%;margin-left:auto;"><center><div class="msg" style="width: 95%;background-color:darkred;padding:8px;margin:auto;">';
            echo '<h4>No result</h4>';
            
            echo '</div>';
        }
    }

    ?>

    <hr style="color: darkgreen;margin-left:auto; width:98.5%">
    <?php
    if (isset($_GET['err_msg'])) {
        echo '<div class="msg" style="width: 99%;background-color:green;padding:8px;margin:auto;">';
        echo '<h4  style="float:left;">' . $_GET['err_msg'] . '</h4>';
        echo '<a href="index_admin.php" class="btn btn-danger" style="margin-left:auto;">x</a>';
        echo '</div>';
    }
    if (isset($_GET['msg'])) {
        echo  '<div class="msg" style="width: 99%;background-color:green;padding:8px;margin:auto;display:flex">';
        echo '<h4 style="float:left;">' . $_GET['msg'] . '</h4>';
        echo '<a href="index_admin.php" class="btn btn-danger" style="margin-left:auto;">x</a>';
        echo '</div>';
    }


    ?>
    <table class="table table-striped table-hovered table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Contact</th>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_data">
                        Add data
                    </button>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT * FROM profile";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed");
            } else {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    <tr>
                        <td id="image-div">
                            <a href="update_image.php?id=<?php echo $row['id'] ?>" class="fa-solid fa-pen-to-square" id="pen"></a>
                            <img src="sample/<?php echo $row['image'] ?>">
                        </td>
                        <td id="name_div"><?php echo $row['name'] ?></td>
                        <td id="contact_div"><?php echo $row['contact'] ?></td>

                        <td id="action-div">
                            <div class="action">
                                <a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-success" id="edit-btn">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" id="delete-btn">X</a>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<form action="insert.php" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="add_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#363232;">Add data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="name" placeholder="Add name . . ." required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="contact" placeholder="Add contact . . ." required>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" name="save_data" value="Save changes">
                </div>
            </div>
        </div>
    </div>
</form>

<?php include 'footer.php'; ?>