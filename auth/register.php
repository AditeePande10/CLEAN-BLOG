<?php require '../includes/header.php'; ?>
<?php require "../config/config.php"; ?>

<?php

if (isset($_SESSION['username'])) {
        header("Location: http://localhost/clean-blog/index.php");
    }

    
if (isset($_POST['submit'])) {
    // Collect form values safely
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if ($_POST['email'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '') {
        echo "Type something in the inputs";
    } else {
        // Encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $insert = $conn->prepare("INSERT INTO users (email, username, mypassword) 
                                  VALUES (:email, :username, :mypassword)");

        $insert->execute([
            ':email' => $email,
            ':username' => $username,
            ':mypassword' => $password
        ]);

        // Redirect after success
        header("location: login.php");
        exit;
    }
}
?>

<!-- Register Form -->
<form method="POST" action="register.php">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" name="email" class="form-control" placeholder="Email" />
  </div>

  <!-- Username input -->
  <div class="form-outline mb-4">
    <input type="text" name="username" class="form-control" placeholder="Username" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" name="password" class="form-control" placeholder="Password" />
  </div>

  <!-- Submit button -->
  <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Register</button>
</form>

<!-- Link to login -->
<div class="text-center">
  <p>Already a member? <a href="login.php">Login</a></p>
</div>

<?php require '../includes/footer.php'; ?>