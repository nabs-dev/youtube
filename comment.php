<?php include 'db.php'; if(!isset($_SESSION['user'])) exit;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['user']['id']; $vid = $_POST['id']; $text = $_POST['text'];
    $conn->query("INSERT INTO comments(user_id, video_id, comment_text, created_at) VALUES($uid, $vid, '$text', NOW())");
}
$vid = $_POST['id'];
$comments = $conn->query("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id=users.id WHERE video_id=$vid ORDER BY created_at DESC");
while($c = $comments->fetch_assoc()){
    echo "<div class='comment'><b>{$c['username']}:</b> {$c['comment_text']} <i style='font-size:12px;color:gray;'> - {$c['created_at']}</i></div>";
}
?>
