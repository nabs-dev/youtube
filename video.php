<?php include 'db.php'; if(!isset($_SESSION['user'])) echo "<script>location.href='login.php'</script>";
$id = $_GET['id']; $conn->query("UPDATE videos SET views=views+1 WHERE id=$id");
$v = $conn->query("SELECT videos.*, users.username FROM videos JOIN users ON videos.uploader_id=users.id WHERE videos.id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html><head><title><?= $v['title'] ?></title>
<style>
body { font-family:sans-serif; background:#f0f0f0; margin:0; padding:20px; }
video { width:100%; max-height:500px; border-radius:10px; }
.container { background:white; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); max-width:800px; margin:auto; }
button { background:red; color:white; padding:5px 10px; border:none; border-radius:5px; cursor:pointer; }
.comment-box, .comment { margin-top:20px; }
</style>
<script>
function likeVideo(){
    fetch('like.php?id=<?= $id ?>').then(res=>res.text()).then(data=>{ document.getElementById("likecount").innerText = data; });
}
function postComment(){
    let text = document.getElementById("cmt").value;
    fetch("comment.php", {
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body: "id=<?= $id ?>&text="+encodeURIComponent(text)
    }).then(res=>res.text()).then(html=>{
        document.getElementById("comments").innerHTML = html;
        document.getElementById("cmt").value = "";
    });
}
window.onload = () => postComment();
</script>
</head><body>
<div class="container">
<video controls src="<?= $v['filename'] ?>"></video>
<h2><?= $v['title'] ?></h2>
<p><?= $v['description'] ?></p>
<p>By <?= $v['username'] ?> | <span id="likecount"><?= $conn->query("SELECT * FROM likes WHERE video_id=$id")->num_rows ?></span> Likes</p>
<button onclick="likeVideo()">Like</button>
<div class="comment-box">
<textarea id="cmt" placeholder="Add a comment..." rows="3" style="width:100%"></textarea>
<button onclick="postComment()">Post</button>
</div>
<div id="comments"></div>
</div>
</body></html>
