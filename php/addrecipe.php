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
        $nazwa=$_POST['txt_nazwa'];
        $kategoria=$_POST['txt_kategoria'];
        $opis=$_POST['txt_opis'];
        $przygotowanie=$_POST['txt_przygotowanie'];
        $id_user=$_SESSION['id'];

        $res = $conn->query("SELECT id FROM recipes WHERE nazwa='$nazwa'");

        $amount_of_recipes = $res->num_rows;

        if($amount_of_recipes > 0)
        {
            $working = false;
        }
        
        if($working == true) 
        {
            if(!empty($_FILES["image"]["name"])) { 
                $fileName = basename($_FILES["image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                $allowTypes = array('jpg'); 
        
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['image']['tmp_name']; 
                    $zdjecie = addslashes(file_get_contents($image)); 
                    $reg="INSERT INTO recipes(nazwa,kategoria,opis,zdjecie,przygotowanie,id_user) Values('$nazwa','$kategoria','$opis','$zdjecie','$przygotowanie','$id_user')";
                    $result = $conn->query($reg);
                    header("Location:ingredients.php");
                }
            }
            
        }
    }
}
$conn->close();
?>