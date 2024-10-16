<?php
include 'dbconn.php';

if(isset($_POST['save_data'])||isset($_FILES['image']) 
|| isset($_POST['name'])|| isset($_POST['contact']))
{
    $filename = $_FILES['image']['name'];

    $tmp= $_FILES['image']['tmp_name'];

    $path= 'sample/'.$filename;

    $name= $_POST['name'];
    $contact= $_POST['contact'];
    if(!move_uploaded_file($tmp,$path))
    {
        header('location:index_admin.php?err_msg=Operation failed');
    }
    elseif($name=='' || empty($name)){
        header('location:index_admin.php?err_msg=Operation failed');
    }
    elseif($contact=='' || empty($contact)){
        header('location:index_admin.php?err_msg=Operation failed');
    }
    else{
        $query= "INSERT INTO profile (`image`,`name`,`contact`)VALUES('$filename','$name','$contact')";
        $result=mysqli_query($conn,$query);

        if(!$result)
        {
            die("Query failed");
        }
        else{
            header('location:index_admin.php?msg=Data added successfully');
        }
    }

}
?>