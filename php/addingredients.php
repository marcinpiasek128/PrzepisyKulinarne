<?php
require("connect.php");
session_start();
$working=true;

if($conn->connect_errno!=0) 
{
    echo "Error: ".$conn->connect_errno;
}
else 
{
    if(isset($_POST['but_submit'])) 
    {
        $skladnik=$_POST['txt_skladnik'];
        $id=$_POST['id'];

        $res = $conn->query("SELECT id FROM ingredients WHERE id_recipe='$id' AND skladnik='$skladnik'");

        $amount_of_recipes = $res->num_rows;

        if($amount_of_recipes > 0)
        {
            $working = false;
        }
        
        if($working == true) 
        {
        
            $reg="INSERT INTO ingredients(id_recipe,skladnik) Values('$id','$skladnik')";
            $result = $conn->query($reg);
            header("Location:ingredients.php");
        }
    }
}
$conn->close();
?>