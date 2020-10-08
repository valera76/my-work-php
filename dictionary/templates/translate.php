<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="http://localhost:8080/styles/style_translate.css">  
    <link rel="stylesheet" type="text/css" href="http://localhost:8080/styles/main.css" >
    <script src="scripts/jquery.js"></script>
    <script src="scripts/site.js"></script>
</head>
<body>
    <header>
        <?php include __DIR__ . '/header.php'; ?> 
    </header>
        <h2 class="title">Translate - Перевод</h2>  
    <div>
        <form class="word" action="/src/new_word.php" method="POST">
            <label>English words</label>
            <textarea rows="10" cols="50" name="english"></textarea>
            <label>Russian words</label>
            <textarea rows="10" cols="50" name="russian"></textarea>
            <br>
            <dd><input type="submit" value="Отправить"></dd>
        </form>
    </div>

    <footer>
    <?php include __DIR__ . '/footer.php'; ?> 
    </footer>
</body>
</html>


