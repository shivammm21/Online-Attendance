<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">


          <form action="#" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="RollNo" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" />
            </div>
            <input type="button" value="Login" class="btn solid" onclick="checkCredentials()" />
                    <script>
                        function checkCredentials() {
                            var username = document.querySelector(".sign-in-form input[type='text']").value;
                            var password = document.querySelector(".sign-in-form input[type='password']").value;

                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "check_credentials.php", true);

                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    var response = xhr.responseText;

                                    if (response.trim() === "success") {
                                        // Redirect to index.php and pass username as a parameter
                                        window.location.href = "index.php";
                                    } else {
                                        var errorMessage = document.createElement("p");
                                        errorMessage.innerHTML = "Wrong username or password";
                                        errorMessage.style.color = "red";
                                        document.querySelector(".sign-in-form").appendChild(errorMessage);
                                    }
                                }
                            };

                            // Send both username and password in the request
                            xhr.send("username=" + username + "&password=" + password);
                        }
                    </script>
          </form>


          <form action="#" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" for="rollno" id="rollno" name="rollno" placeholder="RollNo" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" for="studentName" id="studentName" name="studentName" placeholder="Full Name" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" for="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Create Password" required/>
            </div>
            <input type="submit" class="btn" onclick="createData(event)" value="Sign up" />
<script>
    function createData(event) {
        event.preventDefault();  // Prevent the form from submitting

        var rollno = document.querySelector(".sign-up-form input[name='rollno']").value;
        var studentName = document.querySelector(".sign-up-form input[name='studentName']").value;
        var password = document.querySelector(".sign-up-form input[name='password']").value;

        var xhr1 = new XMLHttpRequest();
        xhr1.open("POST", "register.php", true);

        xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr1.onreadystatechange = function () {
            if (xhr1.readyState == 4) {
                if (xhr1.status == 200) {
                    var response = xhr1.responseText;

                    if (response.trim() === "success") {
                        // Redirect to index.php and pass username as a parameter
                        var successMessage = document.createElement("p");
                        successMessage.innerHTML = "Created Successfully";
                        successMessage.style.color = "green";
                        document.querySelector(".sign-up-form").appendChild(successMessage);
                    } else {
                        var errorMessage = document.createElement("p");
                        errorMessage.innerHTML = "Failed to create user";
                        errorMessage.style.color = "red";
                        document.querySelector(".sign-up-form").appendChild(errorMessage);
                    }
                } else {
                    console.error("Error: " + xhr1.status);
                }
            }
        };

        // Send both username and password in the request
        xhr1.send("rollno=" + rollno + "&studentName=" + studentName + "&password=" + password);
    }
</script>

          </form>

          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
            Embark on your educational adventure with a simple sign-in! Logging in for a day of learning and attendance tracking
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
            Open the door to knowledge! Sign in to your student account and embark on a journey of discovery.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
