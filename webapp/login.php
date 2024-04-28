<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sqllogin = "SELECT * FROM `tbl_admins` WHERE `admin_email` = '$email' AND `admin_password` = '$password'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    if ($number_of_rows > 0) {
        echo "<script>alert('Login Success')</script>";
    }else{
        echo "<script>alert('Login Failed')</script>";
    }
}



?>


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
        <a href="../index.html" class="w3-bar-item w3-button">Home</a>
    </div>
    <div style="min-height:100vh;overflow-y: auto;">
        <div class="w3-container w3-padding-64">
            <div class="w3-card w3-round" style="max-width:600px;margin:auto">
                <div class="w3-container w3-teal">
                    <h4>Login Form</h4>
                </div>
                <form name="loginForm" class="w3-container" action="login.php" method="post">
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
                        <button class="w3-btn w3-round w3-teal w3-block" name="submit" value="submit">Login</button>
                    </p>
                </form>

            </div>

        </div>
    </div>
    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-teal">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>

    <footer class=" w3-container w3-center w3-teal">
        <p>Copyright MyClinic&copy</p>
    </footer>
</body>
<script>
let cookie_consent = getCookie("user_cookie_consent");
if (cookie_consent != "") {
    document.getElementById("cookieNotice").style.display = "none";
} else {
    document.getElementById("cookieNotice").style.display = "block";
}

function deleteCookie(cname) {
    const d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=;" + expires + ";path=/";
}

function acceptCookieConsent() {
    deleteCookie('user_cookie_consent');
    setCookies('user_cookie_consent', 1, 30);
    document.getElementById("cookieNotice").style.display = "none";
}
</script>

</html>