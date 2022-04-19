<?php
require("connect.php");
$q=$_GET["q"];
$query = "SELECT * FROM recipes WHERE id='$q'";
$result = $conn->query($query);
while($row = $result->fetch_array())
{    
    $id = $row['id'];
    $nazwa = $row['nazwa'];
    $kategoria = $row['kategoria'];
    $opis = $row['opis'];
    $zdjecie = $row['zdjecie'];
    $przygotowanie=$row['przygotowanie'];
    $query = "SELECT ROUND(AVG(Rate),1) as averageRating FROM rating WHERE id_recipe=".$id;
    $avgresult = mysqli_query($conn,$query) or die(mysqli_error($conn));
    $fetchAverage = mysqli_fetch_array($avgresult);
    $averageRating = $fetchAverage['averageRating'];     
    $query = "SELECT COUNT(*) as numberRatings FROM rating WHERE id_recipe=".$id;
    $counteresult = $conn->query($query);
    $fetchnumberRatings = $counteresult->fetch_array();
    $numberRatings = $fetchnumberRatings['numberRatings'];   
    if($averageRating <= 0)
    {
        $averageRatings = "Brak oceny";
    }
    if($numberRatings <= 0)
    {
        $numberRatings = "Brak oceny";
    }                     
    echo '<div class="movie">';
    echo '<div class="title">';
    echo $nazwa;  
    echo '</div>';
    echo '<div class="row">';
    echo '<div class="leftcolumn">';
    echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($zdjecie).'" />';
    echo '</div>';
    echo '<div class="rightcolumn">';
    echo '<div class="info">';
    echo 'kategoria: '.$kategoria;
    echo '<ul>skladniki: ';
    $query = "SELECT * FROM ingredients WHERE id_recipe=".$id;
    $result2 = $conn->query($query);
    while($row2 = $result2->fetch_array())
    { 
    $skladnik = $row2['skladnik'];
    echo '<li>'.$skladnik.'</li>';
    };
    echo '</ul>';
    echo '</div>';
    echo '<div class="rating">';
    echo '<h1>Ocena: '.$averageRating.'</h1>';
    echo '<h3>Oceniło: '.$numberRatings.'</h3>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true )
    {
        echo '<form method="post">';
        require_once('rating.php');
        echo '<label for="recipeRating">moja ocena to:</label>';
        echo '<input value="'.$id.'" name="postid" hidden/>';
        echo '<select id="recipeRating" name="recipeRating">';
        echo '<option value="0">0 - Dramat!</option>';
        echo '<option value="1">1 - Nieporozumienie</option>';
        echo '<option value="2">2 - Bardzo zły</option>';
        echo '<option value="3">3 - Słaby</option>';
        echo '<option value="4">4 - Ujdzie</option>';
        echo '<option value="5">5 - Średni</option>';
        echo '<option value="6">6 - Niezły</option>';
        echo '<option value="7">7 - Dobry</option>';
        echo '<option value="8">8 - Bardzo Dobry</option>';
        echo '<option value="9">9 - rewelacyny</option>';
        echo '<option value="10">10 - Arcydzieło!</option>';
        echo '</select>';
        echo '<input type="submit" name="ocen" id="ocen" value="Oceń!" />';
        echo '</form>';
    }
    else{
        echo "Zaloguj się aby ocenić!";
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="description">';
    echo $opis;
    echo '</div>';
    echo '<h1>Sposób przygotowania: </h1>';
    echo '<div class="description">';
    echo $przygotowanie;
    echo '</div>';
    echo '</div>';    
};
?>
