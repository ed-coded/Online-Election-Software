<?php @include 'admin_auth.php'?>
<?php @include 'sidebar.php' ?>

<?php
include 'connectDB.php';

if (isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $deleteQuery = "DELETE FROM students WHERE student_id = $id";

    if (mysqli_query($connectDB, $deleteQuery)) {
        if (mysqli_affected_rows($connectDB) > 0) {
            echo '<div class="alert-success" id="success">student deleted successfully.</div>';
        } else {
            echo '<div class="alert-error" id="error">no student found with such id.</div>';
        }
    } else {
        echo '<div class="alert-error" id="error">an error occurred, could not delete.</div>';
    }
}


$query = "SELECT student_id, student_name, voted FROM students";
$result = mysqli_query($connectDB, $query);


if (!$result) {
    echo '<div class="alert-error" id="error">Error fetching students: ' . mysqli_error($connectDB) . '</div>';
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <style>
        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
            --sub:rgb(157, 160, 235);
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            background-color: var(--base-clr);
            color: var(--text-clr);

        }

        .manage-students-sec {
            max-width: 950px;
            margin-left: 20vw;
            display: block;
            border: 1px solid var(--line-clr);
            border-radius: 1em;
            margin-bottom: 20px;
            margin-top: 2vh;
            padding: min(3em, 15%);

        }


        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 15px;
            background-color: var(--hover-clr);
            border-radius: 8px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.7);
            color: var(--text-clr);
        }

        .responsive-table {
            width: 100%;
            border-collapse: collapse;
        }

        .responsive-table li {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr 1fr;
            align-items: center;
            padding: 15px;
            margin-bottom: 5px;
            border-radius: 5px;
            background-color: var(--base-clr);
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .responsive-table .table-header {
            font-weight: 700;
            background-color: #2b2e3b;
            color: var(--text-clr);
            padding: 15px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .responsive-table .table-row {
            background-color: var(--hover-clr);
            color: var(--secondary-text-clr);
        }

        .delete-btn {
            padding: 8px 14px;
            background-color: var(--sub);
            color: var(--text-clr);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: var(--accent-clr);
            color: var(--text-clr);
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
    <section class="manage-students-sec">
        <h2>MANAGE STUDENTS</h2>

        <body>
            <div class="container">
                <ul class="responsive-table">
                    <li class="table-header">
                        <div>Student ID</div>
                        <div>Student Name</div>
                        <div>Vote Status</div>
                        <div>Action</div>
                    </li>

                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="table-row">
                            <div><?php echo htmlspecialchars($row['student_id']); ?></div>
                            <div><?php echo htmlspecialchars($row['student_name']); ?></div>
                            <div><?php echo $row['voted'] === 'YES' ? 'Voted' : 'Not Voted'; ?></div>
                            <div>
                                <form method="POST" action="manage_students.php" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['student_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>

                        </li>

                    <?php endwhile; ?>
                </ul>
            </div>
    </section>
</body>

<script>
    const delete_success = document.getElementById("success");
    const delete_err = document.getElementById("error");

    setTimeout(()=>{
        delete_success.style.display = "none";
        delete_err.style.display = "none";
    }, 2000)

</script>

</html>