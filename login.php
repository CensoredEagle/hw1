
<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: index.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {
                
                if (session_status() === PHP_SESSION_NONE) {
                session_start();
                }
                $_SESSION['username'] = $entry['username'];
                $_SESSION['user_id'] = $entry['id'];

                header("Location: index.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
    
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }

?>

<html>
    <head>
        <link rel='stylesheet' href='login.css'>
        <link rel="stylesheet" href="responsive.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accedi</title>
    </head>
    <body>
        <main class="login">
        <section class="main">
            <h5>Per continuare, accedi.</h5>
            <?php
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
                
            ?>
            <form name='login' method='post'>
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                </div>
                <div class="submit-container">
                    <div class="login-btn">
                        <input type='submit' value="ACCEDI">
                    </div>
                </div>
            </form>
            <div class="signup"><h4>Non hai un account?</h4></div>
            <div class="signup-btn-container"><a class="signup-btn" href="signup.php">ISCRIVITI</a></div>
        </section>
        </main>
    </body>
</html>
