<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../w3.css">
    <script src="scripts/login.js"></script>
    <title>MyClinic</title>
</head>

<body onload="loadCookies()">
    <header class="w3-container w3-center w3-teal w3-padding-32">
        <h1>MY CLINIC</h1>
        <p>Welcome to Your One Stop Health Solution</p>
    </header>
    <div class="w3-bar w3-teal">
        <a href="#about" class="w3-bar-item w3-button">Home</a>
    </div>
    <div style="min-height:100vh;overflow-y: auto;">
        <div class="w3-container w3-padding-64">
            <div class="w3-card w3-round" style="max-width:600px;margin:auto">
                <div class="w3-container w3-teal">
                    <h3>Login Form</h3>
                </div>
                <form name = "loginForm" class="w3-container" action="login.php" method="">
                    <p>
                        <label class=""><b>Email</b></label>
                        <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
                    </p>
                    <p>
                        <label class=""><b>Password</b></label>
                        <input class="w3-input w3-border w3-round" name="password" type="password" id="idpass" required>
                    </p>
                    <p>
                        <input class="w3-check" type="checkbox" id="idremember" onclick="rememberMe()">
                        <label>Remember Me</label>
                    </p>
                    <p>
                        <button class="w3-btn w3-round w3-teal w3-block" name="submit">Login</button>
                    </p>


                </form>

            </div>

        </div>
    </div>
    <footer class=" w3-container w3-center w3-teal">
        <p>Copyright MyClinic&copy</p>
    </footer>
</body>

</html>