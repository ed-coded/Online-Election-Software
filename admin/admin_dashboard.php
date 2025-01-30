<?php
@include 'admin_auth.php';
@include 'sidebar.php';
@include 'connectDB.php';

$total_students_query = "SELECT COUNT(*) AS total_students FROM students";
$total_students_result = mysqli_query($connectDB, $total_students_query);
$total_students = mysqli_fetch_assoc($total_students_result)['total_students'] ?? 0;

$total_candidates_query = "SELECT COUNT(*) AS total_candidates FROM src_presidents";
$total_candidates_result = mysqli_query($connectDB, $total_candidates_query);
$total_candidates = mysqli_fetch_assoc($total_candidates_result)['total_candidates'] ?? 0;

$total_admins_query = "SELECT COUNT(*) AS total_admins FROM admins";
$total_admins_result = mysqli_query($connectDB, $total_admins_query);
$total_admins = mysqli_fetch_assoc($total_admins_result)['total_admins'] ?? 0;

$voted_query = "SELECT COUNT(*) AS voted_count FROM students WHERE voted = 'YES'";
$voted_result = mysqli_query($connectDB, $voted_query);
$voted_count = mysqli_fetch_assoc($voted_result)['voted_count'] ?? 0;
if ($total_students != 0) {
    $voted_ratio = ($voted_count / $total_students) * 100;
}

$not_voted_query = "SELECT COUNT(*) AS not_voted_count FROM students WHERE voted = 'NO'";
$not_voted_result = mysqli_query($connectDB, $not_voted_query);
$not_voted_count = mysqli_fetch_assoc($not_voted_result)['not_voted_count'] ?? 0;
if ($total_students != 0) {
    $not_voted_ratio = ($not_voted_count / $total_students) * 100;
}
$candidates_query = "SELECT candidate_name, number_of_votes FROM src_presidents";
$candidates_result = mysqli_query($connectDB, $candidates_query);

$candidate_names = [];
$vote_counts = [];

while ($row = mysqli_fetch_assoc($candidates_result)) {
    $candidate_names[] = $row['candidate_name'];
    $vote_counts[] = $row['number_of_votes'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
        }

        *,html {
            overflow: hidden;
        }

        body {
            min-height: 100vh;
            background-color: var(--base-clr);
            color: var(--text-clr);
        }

        .dashboard-sec {
            max-width: 950px;
            padding: 20px;
            margin-left: 20vw;
            margin-top: 10vh;
        }

        .tiles-container {
            display: flex;
            gap: 30px;
            justify-content: space-between;
        }

        .tile {
            width: 20vw;
            height: 19vh;
            padding-top: 20px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: var(--hover-clr);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tile:hover {
            transform: translateY(15px);
            cursor: pointer;
            color: var(--accent-clr);
            z-index: 100;
        }

        .tile h3:hover {
            color: var(--accent-clr);
        }

        .tile h3 {
            margin-bottom: 10px;
            font-size: 25px;
            color: var(--text-clr);
            transition: 0.3s;
        }

        .tile p {
            padding-left: 10px;
            padding-top: 25px;
            font-size: 35px;
            color: var(--accent-clr);
            text-align: left;
            font-weight: bolder;
            font-family: sans-serif;

        }

        .master-container {
            display: flex;
            flex-direction: row;
            height: 100%;
        }

        .chart-container {
            width: 100%;
            max-width: 350px;
            margin-top: 32px;
            margin-left: 0vw;

        }

        .chart-container2 {
            width: 500px;
            margin-top: 15vh;
            margin-left: 4vw;
            height: 500px;

        }

        .corniest-corner {
            position: fixed;
            top: 10px;
            right: 20px;
            font-size: 16px;
            color: var(--text-clr);
            text-align: right;
            display: inline-flex;
            margin-bottom: 5vh;

        }

        .corniest-corner img {
            width: 45px;
            height: 45px;
        }

        .corniest-corner p {
            padding-top: 10px;
            font-size: 20px;
            color: #aeb0e2;
        }
    </style>
</head>

<body>

    <?php $admin_id = $_SESSION['admin_id']; ?>

    <div class="corniest-corner">
        <img src="../assets/icons/admin.svg">
        <p>admin <?php echo $admin_id ?></p>
    </div>

    <section class="dashboard-sec">
        <div class="tiles-container">
            <div class="tile">
                <h3>Total Candidates</h3>
                <p><?php echo $total_candidates; ?></p>
            </div>
            <div class="tile">
                <h3>Total Voters</h3>
                <p><?php echo $total_students; ?></p>
            </div>
            <div class="tile">
                <h3>Total Admins</h3>
                <p><?php echo $total_admins; ?></p>
            </div>
        </div>

        <div class="master-container">
            <div class="chart-container">
                <canvas id="voting-chart"></canvas>
            </div>
            <div class="chart-container2">
                <canvas id="candidates-chart"></canvas>
            </div>
        </div>
    </section>

    <script>
        const voted_ratio = <?php echo $voted_ratio; ?>;
        const not_voted_ratio = <?php echo $not_voted_ratio; ?>;
        const candidate_names = <?php echo json_encode($candidate_names); ?>;
        const vote_counts = <?php echo json_encode($vote_counts); ?>;

        const voting_chart = new Chart(document.getElementById('voting-chart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Voted%', 'Not Voted%'],
                datasets: [{
                    data: [voted_ratio, not_voted_ratio],
                    backgroundColor: ['#5e63ff', '#e6e6ef'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Students Vote Status Statistics'
                    }
                }
            }
        });

        const candidates_chart = new Chart(document.getElementById('candidates-chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: candidate_names,
                datasets: [{
                    label: 'Number of Votes',
                    data: vote_counts,
                    backgroundColor: ['#f39c12', '#e74c3c', '#9b59b6', '#3498db', '#1abc9c', '#f1c40f', '#e67e22', '#ecf0f1', '#2ecc71', '#34495e'],
                    borderColor: 'black',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Candidate Votes Statistics'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Candidates',
                            font: {
                                size: 12
                            }
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Votes',
                            font: {
                                size: 12
                            }
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>