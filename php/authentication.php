<?php
    session_start();
	require("connect.php");
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $ok = true;
    $messages = array();

    if ( !isset($username) || empty($username) ) {
        $ok = false;
        $messages[] = 'Nazwa użytkownika nie może być pusta';
    }

    if ( !isset($password) || empty($password) ) {
        $ok = false;
        $messages[] = 'Hasło nie może być puste';
    }

    if ($ok) {
        
        $result = $conn->query("SELECT id FROM accounts WHERE username='$username' AND password='$password'");
        $ile_takich_kont = $result->num_rows;
        if ($ile_takich_kont!=0) {
            $_SESSION['loggedin']=true;
            $reg="SELECT * FROM accounts WHERE username='$username' AND password='$password'";
            $res = mysqli_query($conn,$reg); 
            $row=$res->fetch_assoc();
            $_SESSION['id']=$row['id'];
            $_SESSION['username']=$row['username'];
            $ok = true;
            $messages[] = 'Zalogowano pomyślnie';
        } else {
            $ok = false;
            $messages[] = 'Niepoprawna kombinacja nazwy użytkownika i hasła';
        }
    }

    echo json_encode(
        array(
            'ok' => $ok,
            'messages' => $messages
        )
    );

?>