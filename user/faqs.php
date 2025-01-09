<?php @include 'auth.php' ?>
<?php @include 'sidebar.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ'S</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        :root {
            --base-clr: #11121a;
            --container-clr: #fff;
            --accent-clr: #5b60fe;
            --hover-clr: #5b60fe;
            --text-clr: #e6e6ef;
        }

        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", "Montserrat", sans-serif;
            box-sizing: border-box;
        }

        html {
            overflow: hidden;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            background-color: var(--base-clr);

        }

        h2 {
            color: var(--text-clr);
            margin-bottom: 2vh;

        }

        #faqs {
            margin: 100px auto;
            color: var(--base-clr);
            max-width: 800px;
            margin-left: 23vw;
        }

        #faqs li {
            list-style: none;
            width: 100%;
            background-color: var(--container-clr);
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        #faqs li label {
            padding: 5px;
            font-weight: 650;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-size: 18px;
        }

        #faqs li label:hover {
            color: var(--hover-clr);
        }

        #faqs li label span {
            transform: rotate(90deg);
            font-size: 22px;
        }

        a {
            text-decoration: none;
            color: var(--accent-clr);
        }

        a:hover {
            color: var(--hover-clr);
            font-weight: 600;
        }

        #faqs label+input[type="radio"] {
            display: none;
        }

        #faqs .content {
            padding: 0 5px;
            line-height: 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 1s;
        }

        #faqs label+input[type="radio"]:checked+.content {
            max-height: 400px;
        }

        @media only screen and (max-width: 768px) {
            #faqs {
                margin: 20px auto;
                max-width: 90%;
                padding: 10px;
            }

            h2 {
                font-size: 20px;
                margin-bottom: 15px;
            }

            #faqs li {
                padding: 8px;
                font-size: 14px;
            }

            #faqs li label {
                font-size: 16px;
                padding: 5px;
            }

            #faqs li label span {
                font-size: 18px;
            }

            #faqs .content {
                font-size: 14px;
                line-height: 1.4rem;
                padding: 0 5px;
            }

            a {
                font-size: 14px;
            }

            #faqs li label:hover {
                color: var(--hover-clr);
            }
        }
    </style>
</head>

<body>

    <ul id="faqs">
        <h2>FAQ's</h2>
        <li>
            <label for="first">What is Votech? <span>&#x3e;</span></label>
            <input type="radio" name="votech" id="first" checked>
            <div class="content">
                <p>An online election platform that allows users to securely cast their votes electronically.</p>
            </div>
        </li>
        <li>
            <label for="second">How do I cast my vote? <span>&#x3e;</span></label>
            <input type="radio" name="votech" id="second">
            <div class="content">
                <p>Log in, navigate to the voting section, select your desired option, and submit your vote.</p>
            </div>
        </li>
        <li>
            <label for="third">Who can use this system? <span>&#x3e;</span></label>
            <input type="radio" name="votech" id="third">
            <div class="content">
                <p>Only registered users with valid credentials can access and participate in the voting process.</p>
            </div>
        </li>
        <li>
            <label for="fourth">Can I change my vote after submitting it? <span>&#x3e;</span></label>
            <input type="radio" name="votech" id="fourth">
            <div class="content">
                <p>Log in, navigate to the voting section, select your desired option, and submit your vote.</p>
            </div>
        </li>
        <li>
            <label for="fifth">Who do I contact for support? <span>&#x3e;</span></label>
            <input type="radio" name="votech" id="fifth">
            <div class="content">
                <p>You can reach our support team at <a href="mailto:votechplatform@gmail.com">votechplatform@gmail.com</a>.</p>
            </div>
        </li>
    </ul>
</body>

</html>