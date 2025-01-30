<?php @include 'admin_auth.php'; ?>
<?php @include 'sidebar.php'; ?>
<?php @include 'connectDB.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
    <style>
        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
        }

        body {
            min-height: 100vh;
            background-color: var(--base-clr);
            color: var(--text-clr);
        }

        .results-sec {
            max-width: 950px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid var(--line-clr);
            border-radius: 10px;
            background-color: var(--hover-clr);
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.7);
            margin-top: 2vh;
            margin-left: 20vw;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--text-clr);
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th,
        .results-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid var(--line-clr);
        }

        .results-table th {
            background-color: #2b2e3b;
            color: var(--text-clr);
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
        }

        .results-table td {
            background-color: var(--hover-clr);
            color: var(--secondary-text-clr);
            
        }

        .candidate-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid var(--accent-clr);
        }

        .position-rank p, .num-of-votes p{
            font-weight: bolder;
            color: var(--accent-clr);
            font-size: 25px;
        }

        .no-results {
            text-align: center;
            color: var(--secondary-text-clr);
            font-size: 14px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <section class="results-sec">
        <h2>SRC Election Results</h2>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Image</th>
                    <th>Candidate Name</th>
                    <th>Candidate ID</th>
                    <th>TOT. Votes</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $query = "SELECT candidate_name, candidate_img, candidate_id, number_of_votes FROM src_presidents ORDER BY number_of_votes DESC";
                $result = mysqli_query($connectDB, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $position = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="position-rank"><p>#' . $position . '</p></td>';
                        echo '<td><img src="../assets/candidate-imgs/' . htmlspecialchars($row["candidate_img"]) . '" alt="Candidate Image" class="candidate-img"></td>';
                        echo '<td>' . htmlspecialchars($row["candidate_name"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["candidate_id"]) . '</td>';
                        echo '<td class="num-of-votes"><p>' . htmlspecialchars($row["number_of_votes"]) . '</p></td>';
                        echo '</tr>';
                        $position++; 
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-results'>No results found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>
