<?php include 'db.php'; if(isset($_SESSION['user'])) echo "<script>location.href='index.php'</script>"; ?>
<!DOCTYPE html>
<html><head><title>Login</title>
<style>
body { font-family:sans-serif; background:#f0f0f0; display:flex; align-items:center; justify-content:center; height:100vh; }
form { background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
input, button { width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc; }
button { background:red; color:white; border:none; cursor:pointer; }
</style>
</head><body>
<form method="POST">
<h2>Login</h2>
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button name="login">Login</button>
<p style="text-align:center;"><a href="signup.php">Create new account</a></p>
</form>
<?php
if(isset($_POST['login'])){
    $e = $_POST['email']; $p = $_POST['password'];
    $user = $conn->query("SELECT * FROM users WHERE email='$e'")->fetch_assoc();
    if($user && password_verify($p, $user['password'])){
        $_SESSION['user'] = $user;
        echo "<script>location.href='index.php'</script>";
    } else echo "<script>alert('Invalid login')</script>";
}
?>
</body></html>
