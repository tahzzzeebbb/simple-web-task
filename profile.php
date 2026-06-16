<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$stmt = $conn->prepare("SELECT userName, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>
    <h2>Welcome, <?php echo htmlspecialchars($user['userName']); ?>!</h2>

    <?php if ($user['profile_pic']): ?>
        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" width="200">
    <?php else: ?>
        <p>No profile picture uploaded</p>
    <?php endif; ?>

    <p>This is your profile page.</p>
    <a href="logout.php">Logout</a>
</body>

</html>