<?php include 'connection.php'; 
$id=$_GET['id'];
$query="DELETE FROM student WHERE id='$id' ";
$data = mysqli_query($con, $query);
if ($data) {
    ?>
        <script type="text/javascript">
            alert("Data success Fully Deleted")
            window.open("http://localhost/eduportal/admission-display.php","_self");
        </script>
        <?php    
    }
else {
        ?>
        <script type="text/javascript">
            alert("Please Try Again")
        </script>
        <?php
}

?>