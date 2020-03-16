<!DOCTYPE html>
<?php
  if(isset($_COOKIE['userType'])) {
    header("Location: http://1fourone.io/webgrader/front/" . $_COOKIE['userType'] . ".php");
  }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebQuiz Login</title>
    <style>
        label {
            display: block;
        }

        input, label {
            margin: .4rem 0;
        }

        #submit {
            display: block;
        }
    </style>
    <script>
      function attemptLogin() {
        var uname = document.getElementById("uname").value;
        var pw = document.getElementById("pw").value;

        console.log("I ran!");
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'http://1fourone.io/webgrader/front/login.php', true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //We're sending JSON data in a string
        xhr.onreadystatechange = function() {
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(this.responseText);
            response = JSON.parse(this.responseText);
            if(response['result'] == "success")
              window.location.href = response['type'] + '.php';
            else
              alert("Invalid credentials");
          }
        };

        xhr.send("credentials=" + JSON.stringify({name: uname, plain_password: pw})); //send the JSON
      }

    </script>
  </head>

  <body>
    <h1>Enter your credentials below:</h1>

    <label for="uname">Username:</label>
    <input type="text" id="uname" name="uname" />

    <label for="pw">Password:</label>
    <input type="password" id="pw" name="pw" />

    <input type="submit" id="submit" value="Submit" onclick="attemptLogin();" />

  </body>

</html>