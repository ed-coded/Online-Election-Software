<?php @include 'admin_auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        * {
            margin: 0;
            padding: 0;
        }

        html {
            font-family: "Poppins", "Manrope", "Montserrat", sans-serif;
            line-height: 1.5rem;
        }

        #sidebar {
            box-sizing: border-box;
            height: 100vh;
            width: 250px;
            padding: 5px 1em;
            background-color: var(--base-clr);
            border-right: 1px solid var(--line-clr);
            position: fixed;
            top: 0;
            align-self: self-start;
            margin-right: 5vw;
        }

        #sidebar ul {
            list-style: none;
        }

        .nav-list:hover {
            color: var(--accent-clr);
            cursor: pointer;
        }


        .logo {
            font-weight: 600;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
            font-size: 30px;
        }

        #sidebar a {
            color: var(--accent-clr);
        }

        svg {
            fill: var(--accent-clr);
        }

        hr {
            border-color: #5e63ff;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        #sidebar a,
        #sidebar .logo {
            border-radius: .5em;
            padding: .85em;
            text-decoration: none;
            color: var(--text-clr);
            display: flex;
            align-items: center;
            gap: 1em;
        }

        #sidebar a.active-link {
            color: var(--accent-clr);
            transform: translateX(5px);
        }

        .nav-footer {
            margin-top: 30vh;
        }
    </style>
</head>

<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<body>
    <nav id="sidebar">
        <ul>

            <li><span class="logo">Votech</span></li>

            <li>
                <a href="admin_dashboard.php" class="<?= ($currentPage == 'admin_dashboard.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                    </svg>
                    <span class="nav-list">Dashboard</span></a>
            </li>

            <li>
                <a href="add_candidate.php" class="<?= ($currentPage == 'add_candidate.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M280-280h160v-160H280v160Zm240 0h160v-160H520v160ZM280-520h160v-160H280v160Zm240 0h160v-160H520v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z" />
                    </svg>
                    <span class="nav-list">Add Candidate</span></a>
            </li>

            <li>
                <a href="new_admin.php" class="<?= ($currentPage == 'new_admin.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M280-280h160v-160H280v160Zm240 0h160v-160H520v160ZM280-520h160v-160H280v160Zm240 0h160v-160H520v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z" />
                    </svg>
                    <span class="nav-list">Add New Admin</span></a>
            </li>

            <li>
                <a href="manage_students.php" class="<?= ($currentPage == 'manage_students.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M280-280h160v-160H280v160Zm240 0h160v-160H520v160ZM280-520h160v-160H280v160Zm240 0h160v-160H520v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z" />
                    </svg>
                    <span class="nav-list">Manage Students</span></a>
            </li>

            <li>
                <a href="results.php" class="<?= ($currentPage == 'results.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M80-120v-80h800v80H80Zm40-120v-280h120v280H120Zm200 0v-480h120v480H320Zm200 0v-360h120v360H520Zm200 0v-600h120v600H720Z" />
                    </svg>
                    <span class="nav-list">View Results</span></a>
            </li>

            <!--<hr>-->

            <li class="nav-footer"><a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z" />
                    </svg>
                    <span class="nav-list">Logout</span></a>
            </li>

        </ul>

    </nav>
</body>

</html>