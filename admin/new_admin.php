<?php @include 'admin_auth.php' ?>


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

<?php @include 'sidebar.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Admin</title>
        <style>
            :root {
                --base-clr: #11121a;
                --line-clr: #42434a;
                --hover-clr: #222533;
                --text-clr: #e6e6ef;
                --accent-clr: #5e63ff;
                --secondary-text-clr: #b0b3c1;
                --sub: rgb(157, 160, 235);
            }

            body {
                min-height: 100vh;
                min-height: 100dvh;
                background-color: var(--base-clr);
                color: var(--text-clr);

            }

            .add-admin-sec {
                max-width: 950px;
                margin-left: 20vw;
                margin-top: 2vh;
                display: block;
                border: 1px solid var(--line-clr);
                border-radius: 1em;
                margin-bottom: 20px;
                padding: min(3em, 15%);
            }


            .form-title {
                text-align: center;
                margin-bottom: 20px;
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
                color: var(--text-clr);
            }

            .form-group input {
                width: 97%;
                padding: 10px;
                border: 1px solid var(--line-clr);
                border-radius: 5px;
                background-color: var(--base-clr);
                color: var(--text-clr);
            }

            .submit-btn {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: var(--sub);
                color: var(--text-clr);
                cursor: pointer;
            }

            .submit-btn:hover {
                background-color: var(--accent-clr)
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
            <h2 class="form-title">ADD NEW ADMIN</h2>
            <form action="new_admin.php" method="POST" enctype="multipart/form-data" class="admin-form">

                <div class="form-group">
                    <label for="admin-id">Admin ID:</label>
                    <input maxlength="4" minlength="4" type="number" name="admin_id" required>
                </div>

                <div class="form-group">
                    <label for="admin-password">Admin Password:</label>
                    <input type="password" maxlength="15" minlength="7" name="admin_password" required>
                </div>

                <div class="form-group">
                    <label for="admin-password-confirm">Confirm Admin Password:</label>
                    <input type="password" maxlength="15" minlength="7" name="admin_confirm_password" required>
                </div>

                <button type="submit" name="add_admin" class="submit-btn">ADD ADMIN</button>
            </form>
        </section>

    </body>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const add_success = document.getElementById("success");
            const add_err = document.getElementById("error");

            if (add_success) {
                setTimeout(() => {
                    add_success.style.display = "none";
                }, 2000);
            }

            if (add_err) {
                setTimeout(() => {
                    add_err.style.display = "none";
                }, 2000);
            }
        });
    </script>

    </html>