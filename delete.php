 <?php 
include 'dbconn.php';

if(isset($_GET['id']))
{
    $delete_id=$_GET['id'];
    $query="SELECT * FROM profile WHERE id='$delete_id' ";
    $result=mysqli_query($conn,$query);

    if(!$result){
        die("Query failed");
    }
    else{
        $row = mysqli_fetch_assoc($result);
        $query="DELETE FROM profile WHERE id='$delete_id' ";
        $result=mysqli_query($conn,$query);

        if(!$result){
            die("Query failed");
        }
        else{       
            $image=$row['image'];
            unlink('sample/'.$image);
            mysqli_query($conn,$query);
        
            header('location:index_admin.php?msg=Deleted successfully');
        }
    }
}
 ?>