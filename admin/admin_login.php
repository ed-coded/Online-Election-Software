<?php
@include 'connectDB.php';

if (isset($_POST['login'])) {
    $admin_id = mysqli_real_escape_string($connectDB, $_POST['admin_id']);
    $admin_password = $_POST['admin_password'];

    $query = "SELECT * FROM admins WHERE admin_id = '$admin_id'";
    $result = mysqli_query($connectDB, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($admin_password, $row['admin_password'])) {
                session_start();
                $_SESSION['admin_id'] = $row['admin_id'];
                header("Location: admin_dashboard.php");
            } else {
                echo '<div class="alert-error" id="error">incorrect password.</div>';
            }
        } else {
            echo '<div class="alert-error" id="error">admin does not exist.</div>';
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votech | Admin Login</title>
    <link rel="icon" href="../assets/icons/votech-logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
            --shadow-clr: #363535;
        }

        * {
            margin: 0;
            padding: 0;
        }

        html {
            font-family: "Poppins", "Manrope", "Montserrat", sans-serif;
            line-height: 1.5rem;
            overflow: hidden;
        }

        body {
            background-color: whitesmoke;
        }

        form {
            width: min(350px, 70%, 50vw);
            height: 40vh;
            background-color: white;
            margin: 25vh auto;
            padding: 2rem;
            border-radius: 4px;
            color: var(--text-clr);

            box-shadow: 0 5px 23px rgba(0, 0, 0, 0.4);
        }

        main {
            margin: 1rem auto;
        }

        input {
            height: 1.6rem;
            width: 96%;
            background-color: #e6e6ef;
            border: none;
            border-radius: 3px;
            margin-top: 10px;
            padding: 8px;
            font-size: 17px;
        }

        input::placeholder {
            color: var(--hover-clr);
            font-family: "Manrope";
            font-weight: bolder;
            font-size: 13px;
        }

        input:focus {
            border: none;
            outline: none;
        }

        #first {
            margin-top: 15px;
        }

        h1 {
            color: var(--base-clr);
            text-align: center;
        }

        #submit {
            width: 12vw;
            height: 2.3rem;
            background-color: var(--hover-clr);
            color: white;
            font-weight: bolder;
            font-size: 17px;
            display: block;
            margin: 15px auto;
        }

        #submit:hover {
            background-color: var(--accent-clr);
            box-shadow: 0 3px 21px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .text-login {
            text-align: center;
            margin-top: -5px;
            font-size: 15px;
        }

        .text-login a {
            text-decoration: none;
            color: var(--base-clr);
            font-weight: 600;
        }

        .text-login a:hover {
            cursor: pointer;
            color: var(--accent-clr);
            border-bottom: 1px dashed var(--accent-clr);
        }

        .alert-success {
            background-color: #d4edda;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px 20px;
            border-radius: 8px;
            position: fixed;
            top: 10px;
            right: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            opacity: 1;
            transition: opacity 0.5s ease, transform 0.5s ease;
            transform: translateY(0);

        }

        .alert-error {
            background-color: rgb(238, 202, 202);
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            color: rgb(196, 45, 45);
            border: 1px solidrgb(230, 202, 195);
            padding: 15px 20px;
            border-radius: 8px;
            position: fixed;
            top: 10px;
            right: 20px;
            box-shadow: 0 4px 15px rgba(131, 69, 69, 0.1);
            z-index: 1000;
            opacity: 1;
            transition: opacity 0.5s ease, transform 0.5s ease;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <form action="admin_login.php" method="POST">
        <main>
            <h1>Admin Login</h1>
            <div id="first" class="input-area">
                <input type="number" name="admin_id" placeholder="Admin ID" required>
            </div>
            <div class="input-area">
                <input type="password" minlength="7" name="admin_password" placeholder="Password" required>
                <input id="submit" name="login" class="input-area" type="submit">
                <p class="text-login">
                    <a href="../index.php">back to home</a>
                </p>
            </div>
        </main>
    </form>
</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const success = document.getElementById("success");
        const err = document.getElementById("error");

        if (success) {
            setTimeout(() => {
                success.style.display = "none";
            }, 2000);
        }

        if (err) {
            setTimeout(() => {
                err.style.display = "none";
            }, 2000);
        }
    });
</script>

</html>