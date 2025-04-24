<?php include 'db.php'; if(isset($_SESSION['user'])) echo "<script>location.href='index.php'</script>"; ?>
<!DOCTYPE html>
<html><head><title>Signup</title>
<style>
body { font-family:sans-serif; background:#f9f9f9; display:flex; align-items:center; justify-content:center; height:100vh; }
form { background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
input { width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc; }
button { background:red; color:white; padding:10px; border:none; border-radius:5px; cursor:pointer; width:100%; }
</style>
</head><body>
<form method="POST">
<h2>Create Account</h2>
<input name="username" placeholder="Username" required>
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button name="signup">Signup</button>
<p style="text-align:center;"><a href="login.php">Already have an account?</a></p>
</form>
<?php
if(isset($_POST['signup'])){
    $u = $_POST['username']; $e = $_POST['email']; $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users(username, email, password) VALUES('$u','$e','$p')");
    echo "<script>location.href='login.php'</script>";
}
?>
</body></html>
