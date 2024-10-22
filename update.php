<?php
include 'dbconn.php';
include 'header_update.php';

if (isset($_GET['id'])) {
    $update_id = $_GET['id'];
    $query = "SELECT * FROM profile WHERE id='$update_id' ";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        die("Query failed");
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

?>
<?php
if (isset($_POST['update_data'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    $query = "UPDATE profile SET `name`='$name',`contact`='$contact'WHERE id='$update_id'  ";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed");
    } else {
        header('location:index_admin.php?msg=Data updated successfully');
    }
}
?>
<br>
<br>
<br>
<form action="" method="post" enctype="multipart/form-data">
    <div class="main-container" id="main-container">
        <hr id="hr1">
        <label id="subtitle">Update data</label>
        <hr id="hr2">
        <center>
            <div class="form-group mb-2">
                <img src="sample/<?php echo $row['image'] ?>" alt="" class="img_update">
            </div>
            <div class="form-group mb-2" id="sample-subtitle-div">
                <label class="sample-img">Profile Image</label>
            </div>
        </center>
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" placeholder="Update name . . ." required>
        </div>
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="contact" value="<?php echo $row['contact'] ?>" placeholder="Update contact . . ." required>
        </div>

        <div class="footer">
            <input type="submit" class="btn btn-success" name="update_data" value="Update">
            <a href="index_admin.php" class="btn btn-danger">Back</a>
        </div>
</form>
<?php

?>
</div>


<!-- <form action="update.php" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="add_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#363232;">Update image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <input type="file" class="form-control" name="new_image" required>
                        <input type="hidden" name="old_image" value="<?php echo $row['image'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" name="update_image" value="Save changes">
                </div>
            </div>
        </div>
    </div>
</form> -->
<?php include 'footer.php'; ?>