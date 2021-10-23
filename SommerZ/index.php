<?php
session_start();
include('conn.php');
include('functions.php');
connect();
include("header.php");

if(isset($_SESSION['employee'])){
    echo "Du er logget ind som " . $_SESSION['employee']['fornavn'] . " " . $_SESSION['employee']['efternavn'];
    include('nav.php');
    if(isset($_POST['nav'])){
        include("pages/" . $_POST['nav']);
    }else{
        include("pages/mainpage.php");
    }
}else{
    ?>
    <form method="post">
        <h1>Login</h1>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="password" placeholder="Kodeord" required><br>
        <input type="submit" name="btnlogin" value="Login">
    </form>
    <?php
    if(isset($_POST['btnlogin']))
    {
    $email = $_POST['email'];
    $password = $_POST['password'];
                    
    $employee = getEmployee($email);
    if(isset($employee)){
            if($_POST['password'] == $employee[0]['kode']){
                $_SESSION['employee'] = $employee[0];  
                header("Refresh:0");
            }else{
                echo "Kode eller email er forkert";
            }
        }else{
            echo "Kode eller email er forkert";
        }  
    }
}

include("footer.php");
