<?php include 'db.php'; if(!isset($_SESSION['user'])) exit;
$uid = $_SESSION['user']['id']; $vid = $_GET['id'];
$exists = $conn->query("SELECT * FROM likes WHERE user_id=$uid AND video_id=$vid")->num_rows;
if(!$exists) $conn->query("INSERT INTO likes(user_id, video_id) VALUES($uid, $vid)");
echo $conn->query("SELECT * FROM likes WHERE video_id=$vid")->num_rows;
?>
