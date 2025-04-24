<?php include 'db.php'; if(!isset($_SESSION['user'])) echo "<script>location.href='login.php'</script>"; ?>
<!DOCTYPE html>
<html><head><title>Home</title>
<style>
body { margin:0; font-family:sans-serif; background:#f0f0f0; }
nav { background:red; color:white; padding:15px; display:flex; justify-content:space-between; }
.grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:20px; padding:20px; }
.card { background:white; border-radius:10px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,0.1); cursor:pointer; }
.card img { width:100%; height:150px; object-fit:cover; }
.card .info { padding:10px; }
</style>
</head><body>
<nav>
<div>MyTube</div>
<div><a href="upload.php" style="color:white;">Upload</a> | <a href="logout.php" style="color:white;">Logout</a></div>
</nav>
<div class="grid">
<?php
$videos = $conn->query("SELECT videos.*, users.username FROM videos JOIN users ON videos.uploader_id=users.id ORDER BY created_at DESC");
while($v = $videos->fetch_assoc()){
    echo "<div class='card' onclick=\"location.href='video.php?id={$v['id']}'\">
        <img src='{$v['thumbnail']}'>
        <div class='info'>
            <h4>{$v['title']}</h4>
            <p>{$v['username']} - {$v['views']} views</p>
        </div>
    </div>";
}
?>
</div>
</body></html>
