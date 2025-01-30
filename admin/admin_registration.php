<?php

//adding new admin..

@include 'connectDB.php';

if (isset($_POST['add_admin'])) {
    $admin_id = intval($_POST['admin_id']);
    $admin_password = $_POST['admin_password'];
    $admin_confirm_password = $_POST["admin_confirm_password"];

    if ($admin_password !== $admin_confirm_password) {
        echo '<div class="alert-error" id="error">passwords donot match.</div>';
    } else {
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

        $duplicate_id = "SELECT * FROM admins WHERE admin_id = '$admin_id'";
        $get_rows = mysqli_query($connectDB, $duplicate_id);
        $rows_count = mysqli_num_rows($get_rows);

        if ($rows_count > 0) {
            echo '<div class="alert-error" id="error">admin id already exists.</div>';
        } else {
            $inject = "INSERT INTO admins (admin_id, admin_password) 
             VALUES ('$admin_id','$hashed_password')";

            if (mysqli_query($connectDB, $inject)) {
                echo '<div class="alert-success" id="success">admin added successfully.</div>';
            } else {
                echo '<div class="alert-error" id="error">an unknown error occured.</div>';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This adds a new admin">
    <link rel="icon" href="../assets/icons/votech-logo.png">
    <title>Admin Registration</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
            --sub: rgb(157, 160, 235);
        }

        *{
            margin: 0;
            padding: o;
            overflow: hidden;
            box-sizing: border-box;
        }

        html{
            font-family: "Poppins", "Montserrat", sans-serif;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            color: var(--text-clr);
            background-color: whitesmoke;
        }

        .add-admin-sec {
            max-width: 500px;
            margin: 5rem auto;
            display: block;
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 1em;
            padding: min(3em, 15%);
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        input{
            border: none;
            outline: none;
        }

        .admin-form {
            background-color: var(--hover-clr);
            padding: 20px;
            border-radius: 10px;
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .form-group {
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            margin-left: 3px;
            color: var(--text-clr);
            font-weight: 600;
        }

        .form-group input {
            width: 95%;
            padding: 10px;
            border-radius: 5px;
            background-color: var(--base-clr);
            color: var(--text-clr);
        }

        .submit-btn {
            font-family: "Poppins", "Montserrat", sans-serif;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: var(--base-clr);
            cursor: pointer;
            font-weight: 800;
        }

        .submit-btn:hover {
            background-color: var(--accent-clr);
            color: #fff;
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
        <section class="add-admin-sec">
            <h2 class="form-title">ADD ADMIN</h2>
            <form action="admin_registration.php" method="POST" enctype="multipart/form-data" class="admin-form">

                <div class="form-group">
                    <label for="admin-id">Admin ID:</label>
                    <input type="number" name="admin_id" required>
                </div>

                <div class="form-group">
                    <label for="admin-password">Admin Password:</label>
                    <input type="password" maxlength="15" minlength="7" name="admin_password" required>
                </div>

                <div class="form-group">
                    <label for="admin-password-confirm">Confirm Admin Password:</label>
                    <input type="password" maxlength="15" minlength="7" name="admin_confirm_password" required>
                </div>

                <button type="submit" name="add_admin" class="submit-btn">POPULATE</button>
            </form>
        </section>
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