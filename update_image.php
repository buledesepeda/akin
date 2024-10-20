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
        $row = mysqli_fetch_assoc($result); {

?>
            <form action="update_image.php" method="post" enctype="multipart/form-data">
                <div class="main-container" id="main-container">
                    <hr id="hr1">
                    <label id="subtitle">Update data</label>
                    <hr id="hr2">
                    <center>
                        <div class="form-group mb-2">
                            <img src="sample/<?php echo $row['image'] ?>" alt="" class="img_update">
                        </div>
                        <div class="form-group mb-2">
                            <input type="file" class="form-control" name="new_image" required>
                            <input type="hidden" name="old_image" value="<?php echo $row['image'] ?>">

                        </div>
                    </center>
                    <div class="footer">
                        <input type="submit" class="btn btn-success" name="update_image" value="Save changes">
                        <a href="index_admin.php" class="btn btn-danger">Back</a>
                    </div>
            </form>
<?php
        }
    }
}
?>
<?php
if (isset($_POST['update_image'])) {
    $new_image = $_FILES['new_image']['name'];
    $old_image = $_POST['old_image'];

    $query = "UPDATE profile SET `image`='$new_image'";
    $result = mysqli_query($conn, $query);


    if ($result) {
        if ($_FILES['new_image']['name'] != '') {
            move_uploaded_file($_FILES['new_image']['tmp_name'], "sample/" . $_FILES['new_image']['name']);
            unlink("sample/" . $old_image);
        }
        header('location:index_admin.php?msg=You have successfully updated your sample.');
    } else {
        die("Query failed");
    }
}

?>
</div>

