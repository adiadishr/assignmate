<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM subjects WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject List</title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="./view-subjects.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php include '../../includes/message.php'; ?>
    <div class="container">
        <div class='top-bar'>
            <a class="brand" href="../dashboard/dashboard.php">
                <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
                <h1>Assign<span>Mate</span></h1>
            </a>
            <nav>
                <a href="../create-subject/create-subject.php">
                    <pre><i class="fa-solid fa-plus"></i>  Create subject</pre>
                </a>
                <a href="../dashboard/dashboard.php">Go back</a>
            </nav>
        </div>
        <div class="table-container">
            <h1>Subject List</h1>
            <table>
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Subject Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $index = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $index . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>
                            <a href='../edit-subject/edit-subject.php?id=" . $row['id'] . "'>Edit</a> |
                            <a href='#' class='delete-btn' data-id='" . $row['id'] . "'>Delete</a>
                        </td>";
                            echo "</tr>";
                            $index++;
                        }
                    } else {
                        echo "<tr><td colspan='3'>No subjects found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="delete-modal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <p>Are you sure you want to delete this subject?</p>
                <a href="#" id="confirm-delete" class="btn">Yes</a>
                <button id="cancel-delete" class="btn">No</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const modal = document.getElementById('delete-modal');
            const closeBtn = document.querySelector('.close-btn');
            const confirmDelete = document.getElementById('confirm-delete');
            const cancelDelete = document.getElementById('cancel-delete');
            let subjectId;

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    subjectId = this.getAttribute('data-id');
                    confirmDelete.setAttribute('href', '../../../controllers/delete-subject-controller.php?id=' + subjectId);
                    modal.style.display = 'flex';
                });
            });

            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            cancelDelete.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>