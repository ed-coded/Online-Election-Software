<?php @include 'auth.php' ?>
<?php @include 'sidebar.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast vote</title>
    <style>
        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
            --sub: rgb(157, 160, 235);
            --base-clr2: rgba(8, 9, 17, 0.73);
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            background-color: var(--base-clr);
            color: var(--text-clr);

        }

        .vote-sec {
            max-width: 950px;
            margin-left: 20vw;
            margin-top: 2vh;
            display: block;
            border: 1px solid var(--line-clr);
            border-radius: 1em;
            padding: min(3em, 15%);

        }

        .container {
            max-width: 950px;
            margin: 20px auto;
            padding: 30px;
            background-color: var(--hover-clr);
            border-radius: 10px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.7);
            color: var(--text-clr);
        }

        .responsive-table {
            width: 100%;
            border-collapse: collapse;
        }

        .responsive-table li {
            display: grid;
            grid-template-columns: 100px 2fr 1fr 1fr;
            align-items: center;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: var(--base-clr);
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.5);
        }

        .responsive-table .table-header {
            background-color: #2b2e3b;
            color: var(--text-clr);
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 700;
            padding: 20px;
        }

        .responsive-table .table-row {
            background-color: var(--hover-clr);
            color: var(--secondary-text-clr);
        }


        .responsive-table .candidate-row {
            display: grid;
            grid-template-columns: 100px 2fr 1fr 1fr;
            align-items: center;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.3);
            background-color: var(--hover-clr);
        }


        .candidate-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--accent-clr);
        }

        .vote-btn {
            padding: 12px 18px;
            background-color: var(--sub);
            color: var(--text-clr);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .vote-btn:hover {
            background-color: var(--accent-clr);
            color: var(--text-clr);
        }

        .vote-btn:disabled {
            background-color: var(--text-clr);
            color: var(--base-clr2);
            cursor: not-allowed;
        }

        .vote-btn:disabled:hover {
            color: var(--base-clr2);
        }

        #warning {
            color: rgba(255, 118, 118, 0.94);
            font-weight: bold;
            padding-top: 5px;
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

        @media only screen and (max-width: 768px) {

            h2,
            h3 {
                font-size: 17px;
            }

            #warning {
                font-size: 15px;
            }

            .vote-sec {
                max-width: 100%;
                margin-left: 0;
                padding: 1em;

            }

            .container {
                width: 93%;
                margin-top: 10px;
                padding: 15px;

            }

            .responsive-table {
                margin: 0;
                padding: 0;
                font-size: 10px;


            }

            .responsive-table .table-header {
                display: none;
            }

            .responsive-table .table-row {
                display: grid;
                grid-template-columns: 1fr;
                margin-bottom: 10px;
                padding: 1px;
                text-align: center;
            }

            .responsive-table .table-row div {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 5px 0;
            }

            .candidate-img {
                width: 60px;
                height: 60px;
                align-self: center;
            }

            .vote-btn {
                padding: 8px 8px 10px 5px;
                font-size: 12px;
                width: 90%;
            }

            #warning {
                font-size: 12px;
            }
        }
    </style>
</head>

<?php
require_once 'connectDB.php';

$student_id = $_SESSION['student_id'];
$checkVoteQuery = "SELECT voted FROM students WHERE student_id = '$student_id'";
$voteResult = mysqli_query($connectDB, $checkVoteQuery);
$user = mysqli_fetch_assoc($voteResult);

if (isset($_POST['candidate_id'])) {
    $candidate_id = intval($_POST['candidate_id']);

    if ($user['voted'] === 'NO') {
        $updateVoteQuery = "UPDATE src_presidents SET number_of_votes = number_of_votes + 1 WHERE candidate_id = $candidate_id";
        $updateUserQuery = "UPDATE students SET voted = 'YES' WHERE student_id = '$student_id'";
        $updateResult = mysqli_query($connectDB, $updateVoteQuery);
        $updateUserResult = mysqli_query($connectDB, $updateUserQuery);

        if ($updateResult && $updateUserResult) {
            echo '<div class="alert-success" id="success">vote cast successfully.</div>';
        } else {
            echo '<div class="alert-error" id="error">could not cast vote: ' . mysqli_error($connectDB) . '</div>';
        }
    } else {
        echo '<div class="alert-error" id="error">you have already voted.</div>';
    }
}

$query = "SELECT candidate_name, candidate_img, candidate_id, number_of_votes FROM src_presidents";
$result = mysqli_query($connectDB, $query);

if (!$result) {
    echo '<div class="alert-error" id="error">could not fetch candidates: ' . mysqli_error($connectDB) . '</div>';
}
?>

<body>
    <section class="vote-sec">
        <h2>VOTE HERE</h2>
        <i>
            <p id="warning">*Note: Votes can be made only once, and are irreversible</p>
        </i>
        <br><br>
        <h3>CATEGORY: SRC PRESIDENT</h3>
        <div class="container">
            <ul class="responsive-table">
                <li class="table-header">
                    <div>Image</div>
                    <div>Name</div>
                    <div>Candidate ID</div>
                    <div>Cast Vote</div>
                </li>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <li class="table-row">
                            <div><img src="../assets/candidate-imgs/<?php echo htmlspecialchars($row['candidate_img']); ?>" alt="candidate image" class="candidate-img"></div>
                            <div><?php echo htmlspecialchars($row['candidate_name']); ?></div>
                            <div><?php echo htmlspecialchars($row['candidate_id']); ?></div>
                            <div>
                                <form method="POST" action="cast_vote.php">
                                    <input type="hidden" name="candidate_id" value="<?php echo htmlspecialchars($row['candidate_id']); ?>">
                                    <button type="submit" class="vote-btn" <?php echo ($user['voted'] === 'YES') ? 'disabled' : ''; ?>>Vote</button>
                                </form>
                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <?php echo '<li class="table-row"><div colspan="4"><div class="info">No candidates found</div></div></li>'; ?>
                <?php endif; ?>
            </ul>
        </div>
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