<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/loginoutregis.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Set handler for textboxes -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            var userbox = document.getElementById("username");
            var emailbox = document.getElementById("email");
            var pwbox = document.getElementById("password");
            var pw2box = document.getElementById("password2");
            userbox.onchange = chkusern;
            emailbox.onchange = chkemail;
            pwbox.onchange = chkpwd;
            //pwbox2.onchange=chkpwd2;
        });

        function chkusern(event) {
            var myUser = event.currentTarget;
            var userRegexp = /^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
            //check name
            if (userRegexp.test(myUser.value) == true) {

            } else {
                alert("Unacceptable username");
            }
        }

        function chkemail(event) {
            var myEmail = event.currentTarget;
            var emailRegexp = /^[^@]+@localhost$/;
            //check name
            if (emailRegexp.test(myEmail.value) == true) {

            } else {
                alert("Unacceptable email");
            }
        }

        function chkpwd(event) {
            var myPw = event.currentTarget;
            var pwRegexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
            //check name
            if (pwRegexp.test(myPw.value) == true) {

            } else {
                alert("Unacceptable password");
            }
        }

        function chkpwd2(event) {
            var myPw2 = event.currentTarget;
            var pw2Regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
            //check name
            if (pw2Regexp.test(myPw2.value) == true) {

            } else {
                alert("Unacceptable password");
            }
        }
    </script>
</head>

<body>
    <?php include "header.php"; ?>

    <!--contents-->
    <div id="contents">
        <h2>Registration Page</h2>
        <div class="regis-wrapper">
            <form action="register.php" method=POST>
                <table border="0">
                    <tbody>
                        <tr>
                            <th>Username:</th>
                            <td><input type="text" id="username" name="username" style="width:200px;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(4-20 char, number, alphabet, ., _)</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><input type="text" id="email" name="email" style="width:200px;"></td>
                        </tr>
                        <tr>
                            <th>Password:</th>
                            <td><input type="password" id="password" name="password" style="width:200px;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(at least 6 char, 1 number, 1 special, 1 upper 1 lower)</td>
                        </tr>
                        <tr>
                            <th>Password confirmation:</th>
                            <td><input type="password" id="password2" name="password2" style="width:200px;"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Submit">
                                <input type="reset" name="reset" value="Reset">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <!--end of contents-->

    <?php include "footer.php"; ?>
</body>

</html>