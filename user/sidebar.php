<?php @include 'auth.php' ?>
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
            
            #sidebar li{      
               overflow: hidden;
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
            margin-top: 25vh;
        }

        @media only screen and (max-width: 768px) {
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
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            min-height: 100dvh;
            background-color: var(--base-clr);
            color: var(--text-clr);

        }

        .faqs-sec {
            max-width: 950px;
            margin-left: 20vw;
            margin-top: 2vh;
            display: block;
            border: 1px solid var(--line-clr);
            border-radius: 1em;
            padding: min(3em, 15%);

        }

        a{
            text-decoration: none;
            color: var(--accent-clr);
        }

        html {
            font-family: "Poppins", "Manrope", "Montserrat", sans-serif;
            line-height: 1.5rem;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: var(--base-clr);
            position: fixed;
            top: 0;
            left: -250px;
            transition: left 0.3s ease;
            z-index: 1000;
        }

        #sidebar.active {
            left: 0;
        }

        #sidebar ul {
            list-style: none;
            padding: 10px;
            margin-left: -7vw;
            padding: 2vh;
        }

        #sidebar a,
        #sidebar .logo {
            display: flex;
            align-items: center;
            gap: 1em;
            padding: 0.85em;
            text-decoration: none;
            color: var(--text-clr);
        }

        #sidebar a:hover {
            color: var(--accent-clr);
        }

        .logo {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .nav-list {
            font-size: 16px;
        }

        hr {
            border-color: var(--accent-clr);
            margin: 10px 0;
        }

        svg {
            fill: var(--accent-clr);
        }


        #menu-icon {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--accent-clr);
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            padding-top: 3svh;
            overflow: hidden;
        }


        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        #overlay.active {
            display: block;
        }
            #menu-icon {
                display: block;
            }

            #sidebar ul {
                padding: 20px;
            }

            #sidebar a,
            #sidebar .logo {
                padding: 0.75em;
                text-align: left;
            }

            .nav-footer {
                text-align: left;
                margin-top: 30vh;
            }
        }
    </style>
</head>

<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<body>

    <div id="menu-icon">&#9776;</div>
    <div id="overlay"></div>

    <nav id="sidebar">
        <ul>

            <li><span class="logo">Votech</span></li>

            <li>
                <a href="user_dashboard.php" class="<?= ($currentPage == 'user_dashboard.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                    </svg>
                    <span class="nav-list">Dashboard</span></a>
            </li>

            <li>
                <a href="cast_vote.php" class="<?= ($currentPage == 'cast_vote.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M280-280h160v-160H280v160Zm240 0h160v-160H520v160ZM280-520h160v-160H280v160Zm240 0h160v-160H520v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z" />
                    </svg>
                    <span class="nav-list">Vote</span></a>
            </li>

            <li>
                <a href="results.php" class="<?= ($currentPage == 'results.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M80-120v-80h800v80H80Zm40-120v-280h120v280H120Zm200 0v-480h120v480H320Zm200 0v-360h120v360H520Zm200 0v-600h120v600H720Z" />
                    </svg>
                    <span class="nav-list">Results</span></a>
            </li>

            <li>
                <a href="faqs.php" class="<?= ($currentPage == 'faqs.php') ? 'active-link' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M560-360q17 0 29.5-12.5T602-402q0-17-12.5-29.5T560-444q-17 0-29.5 12.5T518-402q0 17 12.5 29.5T560-360Zm-30-128h60q0-29 6-42.5t28-35.5q30-30 40-48.5t10-43.5q0-45-31.5-73.5T560-760q-41 0-71.5 23T446-676l54 22q9-25 24.5-37.5T560-704q24 0 39 13.5t15 36.5q0 14-8 26.5T578-596q-33 29-40.5 45.5T530-488ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320Zm0-80h480v-480H320v480ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z" />
                    </svg>
                    <span class="nav-list">FAQ's</span></a>
            </li>

            <!--<hr>-->

            <li><a href="mailto:votechplatform@email.com"><img src="../assets/icons/icons8-mail-50.png" height="24px" width="24px">
                    <span class="nav-list">Email Us</span></a>
            </li>

            <li><a target="_blank" href="https://site.gctu.edu.gh/"><img src="../assets/icons/icons8-site-50.png" height="24px" width="24px">
                    <span class="nav-list">Visit Gctu</span></a>
            </li>


            <li class="nav-footer"><a href="user_logout.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z" />
                    </svg>
                    <span class="nav-list">Logout</span></a>
            </li>

        </ul>

    </nav>
</body>
           <script>
        const menuIcon = document.getElementById('menu-icon');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuIcon.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>

</html>