<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'webnangcao';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS,  $DATABASE_NAME);
    if (mysqli_connect_error()){
        exit('Error connecting database' . mysqli_connect_error());
    }
    if(!isset($_POST['txtUsername'], $_POST['txtEmail'], $_POST['txtPassword'], $_POST['txtPassword2'])){
        exit('Empty Fields(s)');
    }
    if(empty($_POST['txtUsername'] || empty($_POST['txtEmail']) || empty($_POST['txtPassword']) || empty($_POST['txtPassword2']))){
        exit('Values Empty');
    }
    if($stmt = $con->prepare('SELECT id, password FROM register WHERE username = ? ')){
        $stmt->bind_param('s', $_POST['txtUsername']);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows>0){
            echo 'Username already Exists. Try again';
        }
        else{
            if($stmt = $con->prepare('INSERT INTO register(username, password, email) VALUES (?,?,?)')){
                $password = password_hash($_POST['txtPassword'], PASSWORD_DEFAULT);
                $stmt-> bind_param('sss', $_POST['txtUsername'], $password, $_POST['txtEmail']);
                $stmt->execute();
                echo 'Succesfully Registered';
            }
            else{
                echo 'Error Occurred';
            }
        }
        $stmt->close();
    }
    else{
        echo 'Error Occurred';
    }
    $con->close();

?>