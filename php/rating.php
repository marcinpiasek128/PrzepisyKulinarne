<?php
require("connect.php");
if($conn->connect_errno!=0) {
    echo "Error: ".$conn->connect_errno;
}
else {
    if(isset($_POST['ocen']))
    {
        $Iduser = $_SESSION['id'];
        $Idrecipe = $_POST['postid'];
        $rate = $_POST['recipeRating'];
        $result = $conn->query("SELECT * FROM rating WHERE id_recipe=".$Idrecipe." and id_user=".$Iduser);
        $ile = $result->num_rows;
        
        if($ile == 0)
        {
            $insertquery = "INSERT INTO rating (id_user, id_recipe, rate) values ('$Iduser','$Idrecipe','$rate')";
            mysqli_query($conn,$insertquery);
        }
        else
        {
        $updatequery = "UPDATE rating SET rate=".$rate." WHERE id_user=".$Iduser." AND id_recipe=".$Idrecipe;
        mysqli_query($conn,$updatequery);   
        }
        
        $query = "SELECT ROUND(AVG(Rate),1) as averageRating FROM rating WHERE id_recipe=".$Idrecipe;
        $result = mysqli_query($conn,$query) or die(mysqli_error());
        $fetchAverage = mysqli_fetch_array($result);
        $averageRating = $fetchAverage['averageRating'];
        
    }
}
?>