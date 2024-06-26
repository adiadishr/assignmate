<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$count_sql = "SELECT COUNT(*) as count FROM assignments WHERE user_id = $user_id AND status != 'completed'";
$count_result = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);
$ns_count_sql = "SELECT COUNT(*) as count FROM assignments WHERE user_id = $user_id AND status = 'Not Started'";
$ns_count_result = mysqli_query($conn, $ns_count_sql);
if ($ns_count_row = mysqli_fetch_assoc($ns_count_result)) {
    $ns_count = $ns_count_row['count'];
}
$ip_count_sql = "SELECT COUNT(*) as count FROM assignments WHERE user_id = $user_id AND status = 'In Progress'";
$ip_count_result = mysqli_query($conn, $ip_count_sql);
if ($ip_count_row = mysqli_fetch_assoc($ip_count_result)) {
    $ip_count = $ip_count_row['count'];
}
$cmp_count_sql = "SELECT COUNT(*) as count FROM assignments WHERE user_id = $user_id AND status = 'Completed'";
$cmp_count_result = mysqli_query($conn, $cmp_count_sql);
if ($cmp_count_row = mysqli_fetch_assoc($cmp_count_result)) {
    $cmp_count = $cmp_count_row['count'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment List</title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="./view-assignments.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php require_once '../../includes/message.php'; ?>
    <div class="container">
        <div class='top-bar'>
            <a class="brand" href="../dashboard/dashboard.php">
                <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
                <h1>Assign<span>Mate</span></h1>
            </a>
            <nav>
                <a href="../create-assignment/create-assignment.php">
                    <pre><i class="fa-solid fa-plus"></i>  Create Assignment</pre>
                </a>
                <a href="../dashboard/dashboard.php">Go back</a>
            </nav>
        </div>
        <!-- <div class="overview">
            <h1>Assignment Overview:</h1>
            <div class="sorting">Sort by: <i class="fa-solid fa-sort-down"></i></div>
        </div> -->
        <div class='view-assignments-main'>
            <div class="main-left">
                <div class="pending-container">
                    <h1>Remaining:</h1>
                    <h1><?= $count_row['count'] ?></h1>
                </div>
                <div class="legend">
                    <h1>Quick Track:</h1>
                    <div class="list">
                        <div class="row">
                            <div>
                                <i class="fa-solid fa-book status-not-started"></i>
                                <span>Not Started</span>
                            </div>
                            <h5><?= $ns_count ?></h5>
                        </div>
                        <div class="row">
                            <div>
                                <i class="fa-solid fa-bars-progress status-in-progress"></i>
                                <span>In Progress</span>
                            </div>
                            <h5><?= $ip_count ?></h5>
                        </div>
                        <div class="row">
                            <div>
                                <i class="fa-solid fa-check-double check status-completed"></i>
                                <span>Completed</span>
                            </div>
                            <h5><?= $cmp_count ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="assignment-list">
                <?php
                $sql = "SELECT assignments.*, subjects.name 
               FROM assignments 
               INNER JOIN subjects ON assignments.subject_id = subjects.id 
               WHERE assignments.user_id = $user_id
               ORDER BY assignments.priority";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $due_date = $row['due_date'];
                    $due_date_object = new DateTime($due_date);
                    $formatted_due_date = $due_date_object->format('F j, Y');
                ?>
                    <a class='assignment-card' href="../view-assignment-detail/view-assignment-detail.php?id=<?= $row['id'] ?>">
                        <div class="title">
                            <div class="titlebar">
                                <?php
                                $status_classes = [
                                    'Not Started' => 'status-not-started',
                                    'In Progress' => 'status-in-progress',
                                    'Completed' => 'status-completed'
                                ];
                                ?>
                                <i class="fa-solid fa-book <?= isset($status_classes[$row['status']]) ? $status_classes[$row['status']] : null; ?>"></i>
                                <h5><?php echo ucfirst($row['title']) ?></h5>
                            </div>
                            <div class="title-right">
                                <span>Due: <?= $formatted_due_date ?></span>
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
                            </div>
                        </div>
                        <div class="card-details">
                            <h5><?= ucfirst($row['name']) ?></h5>
                            <!-- <p><?= ucfirst($row['status']) ?></p> -->
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>