<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="http://localhost:8080/styles/style_login.css">  
    <link rel="stylesheet" type="text/css" href="http://localhost:8080/styles/main.css" >
    <script src="scripts/jquery.js"></script>
    <script src="scripts/site.js"></script>
</head>
<body>
    <header>
        <?php include __DIR__ . '/header.php'; ?> 
    </header>
        <h2 class="reg">Войти в аккаунт</h2>  
        <form class="...." action="/src/....php" name="login" method="POST">
    <div>
        <label>Login</label>
    </div>
    <div>
        <input type="text" name="login">
    </div>
    <br>
    <div>
        <label>Password</label>
    </div>
    <div>
        <input type="password" name="pass">
    </div>
    <br>
        <input type="submit" value="Войти">
    </form>

    <footer>
    <?php include __DIR__ . '/footer.php'; ?> 
    </footer>
</body>
</html>


