<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/StyleLogin.css">
    <script src="Javascript/scripts.js"></script>
</head>

<body onload="EsciDallaPagina()">
    <div id="id01" class="modal">
        <form class="modal-content animate" action="/action_page.php" method="post">
            <div class="imgcontainer">
                <span onclick=" window.history.back()" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <button on type="submit">Login</button>
            </div>
        </form>
    </div>

    
</body>
</html>