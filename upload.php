<?php include 'db.php'; if(!isset($_SESSION['user'])) echo "<script>location.href='login.php'</script>"; ?>
<!DOCTYPE html>
<html><head><title>Upload</title>
<style>
body { font-family:sans-serif; background:#fafafa; padding:30px; }
form { background:white; padding:20px; border-radius:10px; max-width:500px; margin:auto; box-shadow:0 0 10px rgba(0,0,0,0.1); }
input, textarea { width:100%; margin:10px 0; padding:10px; border:1px solid #ccc; border-radius:5px; }
button { background:red; color:white; padding:10px; border:none; border-radius:5px; cursor:pointer; }
</style>
</head><body>
<form method="POST" enctype="multipart/form-data">
<h2>Upload Video</h2>
<input name="title" placeholder="Video Title" required>
<textarea name="desc" placeholder="Description" required></textarea>
<input name="thumbnail" type="file" accept="image/*" required>
<input name="video" type="file" accept="video/*" required>
<button name="upload">Upload</button>
</form>
<?php
if(isset($_POST['upload'])){
    $title = $_POST['title']; $desc = $_POST['desc'];
    $thumb = $_FILES['thumbnail']; $video = $_FILES['video'];

    if($video['size'] > 100*1024*1024) die("Max size is 100MB");

    $tn = 'uploads/thumb_'.time().'.jpg';
    $vf = 'uploads/vid_'.time().'.mp4';

    move_uploaded_file($thumb['tmp_name'], $tn);
    move_uploaded_file($video['tmp_name'], $vf);

    $uid = $_SESSION['user']['id'];
    $conn->query("INSERT INTO videos(title, description, thumbnail, filename, uploader_id, created_at, views) VALUES('$title', '$desc', '$tn', '$vf', $uid, NOW(), 0)");

    echo "<script>alert('Uploaded!'); location.href='index.php'</script>";
}
?>
</body></html>
