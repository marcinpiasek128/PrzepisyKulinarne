
<?php
    require('adduser.php');
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <title>FoodHeaven</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/search.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/signup.css" />
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
            <div id="div_login">
    <form method="post">

        <h1>Rejestracja</h1>
        <div>
            <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Nazwa użytkownika">
        </div>
        <div>
            <input type="text" class="textbox" id="txt_email" name="txt_email" placeholder="E-Mail">
        </div>
        <div>
            <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Hasło">
        </div>
        <div>
            <input type="password" class="textbox" id="txt_pwd_repeat" name="txt_pwd_repeat" placeholder="Powtórz hasło">
        </div>
        <div>
            <input type="submit" value="Zarejestruj" name="but_submit" id="but_submit">
        </div>
        <div>
        <?php
                            if(isset($_SESSION['e_txt_uname']))
                            {
                                echo '<div class="error">'.$_SESSION['e_txt_uname'].'</div>';
                                unset($_SESSION['e_txt_uname']);
                            }
                        
                            if(isset($_SESSION['e_txt_email']))
                            {
                                echo '<div class="error">'.$_SESSION['e_txt_email'].'</div>';
                                unset($_SESSION['e_txt_email']);
                            }
                       
                            if(isset($_SESSION['e_txt_pwd']))
                            {
                                echo '<div class="error">'.$_SESSION['e_txt_pwd'].'</div>';
                                unset($_SESSION['e_txt_pwd']);
                            }
        ?>
        </div>
    </form>
</div>
        </div>
        <div id="footer">
            2022&copy;Marcin Piasek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>


