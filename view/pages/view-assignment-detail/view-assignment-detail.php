<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_SESSION['user_id'];
    $id = $_GET['id'];
    $sql = "SELECT assignments.*,subjects.name FROM assignments INNER JOIN subjects ON assignments.subject_id = subjects.id WHERE assignments.id = $id AND assignments.user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $assingned_date = $row['assigned_date'];
    $assigned_date_object = new DateTime($assingned_date);
    $formatted_assigned_date = $assigned_date_object->format('F j, Y');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['title'] ?></title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="./view-assignment-detail.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php require_once '../../includes/message.php'; ?>
    <div class="container">
        <div class='top-bar'>
            <div class='assignment-header'>
                <a class="brand" href="../dashboard/dashboard.php">
                    <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
                    <h1>Assign<span>Mate</span></h1>
                </a>
                <div class="detail-header">
                    <i class="fa-solid fa-chevron-right"></i>
                    <h5><?= $row['name'] ?></h5>
                </div>
            </div>

            <nav>
                <a href="../view-assignments/view-assignments.php">Go back</a>
            </nav>
        </div>
        <div class="main">
            <div class="header">
                <div class='titlebar'>
                    <?php
                    $status_classes = [
                        'Not Started' => 'status-not-started',
                        'In Progress' => 'status-in-progress',
                        'Completed' => 'status-completed'
                    ];
                    ?>
                    <div>
                        <i class="fa-solid fa-book <?= isset($status_classes[$row['status']]) ? $status_classes[$row['status']] : null; ?>"></i>
                        <h5>
                            <?= $row['title'] ?> -
                            <div class="priority
                                <?php
                                $priority_classes = [
                                    'high' => 'priority-high',
                                    'medium' => 'priority-medium',
                                    'low' => 'priority-low'
                                ];
                                echo isset($priority_classes[$row['priority']]) ? $priority_classes[$row['priority']] : null;
                                ?>">
                                <?php echo ucfirst($row['priority']) . ' Priority' ?>
                            </div>
                        </h5>
                    </div>
                    <button id="assignment-options-btn" onclick="toggleAssignmentOptions()"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <div style="display: none" id="assignment-options">
                        <a href="../../../controllers/delete-assignment-controller.php?id=<?= $row['id'] ?>">
                            <i class='fa-solid fa-trash-can'></i>
                            Delete Assignment
                        </a>
                        <a href="">
                            <i class='fa-solid fa-pencil'></i>
                            Edit Assignment
                        </a>
                    </div>
                </div>
                <div class="subtitlebar">
                    <p>Assigned on: <?= $formatted_assigned_date ?></p>
                    <p>Due on: <?= $formatted_assigned_date ?></p>
                </div>
            </div>
            <div class="body">

                <h5>
                    <span>Status: <span style='display: flex;' id="status-label">
                            <?= $row['status'] ?></span>
                        <form id="status-form" style='display: none;' action="../../../controllers/edit-assignment-status-controller.php" method="post">
                            <select name="status">
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <input type="text" style="display: none;" name="assignment_id" value="<?= $row['id'] ?>">
                            <input style="display: none;" id="status-submit" type="submit" value="Update Status" />
                        </form>
                    </span>
                    <button id="status-btn" onclick="toggleStatusForm()"><i class="fa-solid fa-pencil"></i></button>
                </h5>

                <h5>
                    Description:
                    <button onclick="toggleEditDesc()" id="desc-btn"><i class="fa-solid fa-pencil"></i></button>
                </h5>
                <form id="desc-form" method="post" action="../../../controllers/edit-assignment-description-controller.php">
                    <textarea rows='10' id="description" name="description" disabled><?= $row['description'] ?></textarea>
                    <input type="text" style="display: none;" name="assignment_id" value="<?= $row['id'] ?>">
                    <input style="display: none;" id="desc-submit" type="submit" value="Update Description" />
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    const descBtn = document.getElementById('desc-btn');
    const desc = document.getElementById('description');
    const descSubmit = document.getElementById('desc-submit');
    const assignmentOptions = document.getElementById('assignment-options');
    const statusForm = document.getElementById('status-form');
    const statusLabel = document.getElementById('status-label');
    const statusBtn = document.getElementById('status-btn');
    const statusSubmit = document.getElementById('status-submit');

    function toggleEditDesc() {
        if (desc.disabled) {
            desc.disabled = false;
            descBtn.innerHTML = '<i class="fa-solid fa-cancel"></i>';
            descSubmit.style.display = 'flex';
        } else {
            desc.disabled = true;
            descBtn.innerHTML = '<i class="fa-solid fa-pencil"></i>';
            descSubmit.style.display = 'none';
        }
    }

    function toggleAssignmentOptions() {
        if (assignmentOptions.style.display === 'none') {
            assignmentOptions.style.display = 'flex';
        } else {
            assignmentOptions.style.display = 'none';
        }
    }

    function toggleStatusForm() {
        if (statusForm.style.display === 'none') {
            statusForm.style.display = 'flex';
            statusLabel.style.display = 'none';
            statusBtn.innerHTML = '<i class="fa-solid fa-cancel"></i>';
            statusSubmit.style.display = 'flex';
        } else {
            statusForm.style.display = 'none';
            statusLabel.style.display = 'flex';
            statusBtn.innerHTML = '<i class="fa-solid fa-pencil"></i>';
            statusSubmit.style.display = 'none';
        }
    }
</script>

</html>