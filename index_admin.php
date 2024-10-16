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
        <div class="search-div">
            <input type="text" name="search" id="search-btn" placeholder="Search profile . . .">
            <button type="submit"><i class="fa fa-search" style="color: black;"></i></button>
        </div>
    </div>
    <hr style="color: darkgreen;margin-left:auto; width:98.5%">
       <?php
       if(isset($_GET['err_msg'])){
        echo '<div class="msg" style="width: 100%;background-color:green;padding:8px;">';
        echo '<h4>'. $_GET['err_msg'].'</h4>';
        echo '</div>';

       }
       if(isset($_GET['msg'])){
        echo  '<div class="msg" style="width: 100%;background-color:green;padding:8px;">';
        echo '<h4>'. $_GET['msg'].'</h4>';
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
            $query="SELECT * FROM profile";
            $result=mysqli_query($conn,$query);

            if(!$result){
                die("Query failed");
            }
            else{
                while($row=mysqli_fetch_assoc($result)){
            
            ?>
            <tr>
                <td><img src="sample/<?php echo $row['image']?>"></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['contact']?></td>

                <td>
                    <div class="action">
                        <a href="" class="btn btn-success" id="edit-btn">Edit</a>
                        <a href="" class="btn btn-danger" id="delete-btn">X</a>
                    </div>
                </td>
            </tr>
            <?php
                }}
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

<?php include 'footer.php';?>