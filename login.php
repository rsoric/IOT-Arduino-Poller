<?php include_once "header.php"; 

if (isset($_COOKIE["Admin"]))
{
   header('Location: dashboard.php');
}
?>

<main class="px-3">

    <form id="login-form" action="Backend/login_validation.php" method="post">
        <?php
  if (isset($_GET["error"]))
  {
    if($_GET["error"] == "wrongcredentials")
    {
      echo "<p>Wrong email or password!</p>";
    }
  }
?>
        <div class="form-floating">
            <input type="username" name="adminUsername" class="form-control" id="floatingInput" placeholder="username"
                required>
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input type="password" name="adminPassword" class="form-control" id="floatingPassword"
                placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary login-button" type="submit">Log in</button>
    </form>

</main>

<?php include_once "footer.php"; ?>