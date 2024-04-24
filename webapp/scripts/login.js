function rememberMe(){
    var email = document.forms["loginForm"]["idemail"].value;
    var pass = document.forms["loginForm"]["idpass"].value;
    var rememberme = document.forms["loginForm"]["idremember"].checked;
    if (rememberme && email != "" && pass != "") {
        setCookies("cemail", email, 5);
        setCookies("cpass", pass, 5);
        setCookies("cremember", rememberme, 5);
        console.log("COOKIES:" + email, pass, rememberme);
        alert("Credential Stored");
    }else{
        setCookies("cemail", "", 5);
        setCookies("cpass", "", 5);
        setCookies("cremember", rememberme, 5);
        document.forms["loginForm"]["idemail"].value = "";
        document.forms["loginForm"]["idpass"].value = "";
        document.forms["loginForm"]["idremember"].checked = false;
        console.log("COOKIES:" + email, pass, rememberme);
        alert("Credential Removed");
    }
}

function setCookies(cookiename, cookiedata, exdays) {
    console.log("COOKIES:" + cookiename);
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
  }
  
  function loadCookies(){
    var email = getCookie("cemail");
    var password = getCookie("cpass");
    var rememberme = getCookie("cremember");
    document.forms["loginForm"]["idemail"].value = email;
    document.forms["loginForm"]["idpass"].value = password;
    if (rememberme && email !="" || password != "") {
        document.forms["loginForm"]["idremember"].checked = true;
    } else {
        document.forms["loginForm"]["idremember"].checked = false;
    }
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
