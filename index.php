
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <title>FoodHeaven</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/searchin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/recipe.css" />
</head>

<body>

    <div id="all">
        <div id="navigation">
            <ol>
                <li><a href="index.php">Strona Główna</a></li>
                <li>
                   <form action="">
                       <input onkeyup="showCustomer(this.value)" class="wyszukaj" type="text" placeholder="Wpisz aby wyszukać" id="search">
                   </form>
                </li>
                <li><a>Posiłki</a>
                    <ul>
                        <li><a href="php/category.php?q=sniadanie">Śniadanie</a></li>
                        <li><a href="php/category.php?q=obiad">Obiad</a></li>
                        <li><a href="php/category.php?q=kolacja">Kolacja</a></li>
                    </ul>
                </li>
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo "<li><a href="."#".">".$_SESSION['username']."</a>
                            <ul>
                                <li><a href="?><?php
                                    
                                    
                                        echo"php/profil.php";
                                    ?><?php echo">Profil</a></li>
                                <li><a href="."php/logout.php".">Wyloguj</a></li>
                             </ul>
                        </li>";
                    }
                    else {
                        echo "<li><a href="."php/login.php".">Logowanie</a></li>";
                    }    
                ?>
            </ol>
        </div>
        <div id="content">
            <?PHP require_once("php/randomRecipe.php");?>
        </div>
        <div id="footer">
            2022&copy;Marcin Piasek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>
