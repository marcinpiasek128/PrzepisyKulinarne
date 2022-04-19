
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <title>FoodHeaven</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/search.js"></script>
</head>

<body>

    <div id="all">
        
        <div id="navigation">
            <ol>
                <li><a href="../index.php">Strona Główna</a></li>
                <li>
                   <form action="">
                       <input onkeyup="showCustomer(this.value)" class="wyszukaj" type="text" placeholder="Wpisz aby wyszukać" id="search">
                   </form>
                </li>
                <li><a>Posiłki</a>
                    <ul>
                    <li><a href="category.php?q=sniadanie">Śniadanie</a></li>
                        <li><a href="category.php?q=obiad">Obiad</a></li>
                        <li><a href="category.php?q=kolacja">Kolacja</a></li>
                    </ul>
                </li>
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo "<li><a href="."#".">".$_SESSION['username']."</a>
                            <ul>
                                <li><a href="?><?php
                                    
                                    
                                        echo"../php/profil.php";
                                    ?><?php echo">Profil</a></li>
                                <li><a href="."../php/logout.php".">Wyloguj</a></li>
                             </ul>
                        </li>";
                    }
                    else {
                        echo "<li><a href="."../php/login.php".">Logowanie</a></li>";
                    }    
                ?>
            </ol>
        </div>
        <div id="content">
        <form method="post" action="addingredients.php">
                <div id="div_login">
                    <h1>Dodaj Składnik</h1>
                    <?php 
                        require("connect.php");   
                        $query='SELECT id FROM recipes ORDER BY id DESC LIMIT 1';
                        $countresult = $conn->query($query);
                        $fetch = $countresult->fetch_array();
                        $id = $fetch['id'];
                        echo '<input value="'.$id.'" name="id" hidden/>'
                    ?>
                    <div>
                        <input type="text" class="textbox" id="txt_skladnik" name="txt_skladnik" placeholder="Skladnik" />
                    </div>
                    <div>
                        <input type="submit" value="Dodaj!" name="but_submit" id="but_submit" />
                    </div>
                </div>
            </form>
        </div>
        <div id="footer">
            2022&copy;Marcin Piasek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>
