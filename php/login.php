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
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
    <style>
        body {
            height: 100%;
            font-family: 'Lato', sans-serif;
            font-size: 20px;
            margin: 0 !important;
        }

        #div_login {
            text-align: center;
        }

        .form .textbox {
            margin-bottom: 10px;
            height: 35px;
            width: 200px;
            text-align: center;

        }

        .form button[type=submit] {
            border: none;
            font-size: 20px;
            background-color: #3498DB;
            width: 200px;
            height: 35px;
            color: #ececec;
        }

        .form button[type=submit]:hover {
            background-color: #56bafd;
        }

        .form a {
            width: 200px;
            height: 35px;
            color: #ececec;
            text-decoration: none;
            display: block;
            background-color: #3498DB;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            line-height: 175%;
        }

        .form a:hover {
            background-color: #56bafd;
        }

        </style>
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
                                    
                                    
                                        echo"profil.php";
                                    ?><?php echo">Profil</a></li>
                                <li><a href="."logout.php".">Wyloguj</a></li>
                             </ul>
                        </li>";
                    }
                    else {
                        echo "<li><a href="."login.php".">Logowanie</a></li>";
                    }    
                ?>
            </ol>
        </div>
        <div id="content">
            <div id="div_login">
    <div class="form">

        <h1>Logowanie</h1>
        <div>
            <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Nazwa użytkownika">
        </div>
        <div>
            <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Hasło">
        </div>
        <div>
            <button type="submit" name="but_submit" id="but_submit">Zaloguj</button>
        </div>
        <div>
            <a href="signup.php" class="sign">Załóż konto</a>
        </div>
        <ul id="form_messages" style="list-style-type: none;"></ul>
        <script>
            const form = {
                username: document.getElementById("txt_uname"),
                password: document.getElementById("txt_pwd"),
                submit: document.getElementById("but_submit"),
                messages: document.getElementById("form_messages"),
            };

            form.submit.addEventListener("click", () => {
                const request = new XMLHttpRequest();

                request.onload = () => {
                    let responseObject = null;

                    try {
                        responseObject = JSON.parse(request.responseText);
                    } catch (e) {
                        console.error("Problem z JSON!");
                    }

                    if (responseObject) {
                        handleResponse(responseObject);
                    }
                };

                const requestData = `username=${form.username.value}&password=${form.password.value}`;

                request.open("post", "authentication.php");
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(requestData);
            });

            function handleResponse(responseObject) {
                if (responseObject.ok) {
                    location.href = "profil.php";
                } else {
                    while (form.messages.firstChild) {
                        form.messages.removeChild(form.messages.firstChild);
                    }

                    responseObject.messages.forEach((message) => {
                        const li = document.createElement("li");
                        li.textContent = message;
                        form.messages.appendChild(li);
                    });

                    form.messages.style.display = "block";
                }
            }

        </script>
    </div>
</div>
        </div>
        <div id="footer">
            2022&copy;Marcin Piasek. Wszelkie prawa zastrzeżone.
        </div>
    </div>
</body>

</html>
