<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 


    // check for thr submit

    // take the data from input

    // write our query

    // execute and then fetch

    // do our rowCount

    // to do our password_verify function + user to the index page

    if (isset($_SESSION['username'])) {
        header("Location: http://localhost/clean-blog/index.php");
    }
        

    if(isset($_POST['submit'])){

        if ($_POST['email'] == '' OR $_POST['password'] == '') {
            echo "ONE INPUT OR MORE ARE EMPTY";
        }
        else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $login = $conn->prepare("SELECT * FROM users WHERE email = :email");

            $login->execute([':email' => $email]);

            $row = $login->fetch(PDO::FETCH_ASSOC);

            if ($login -> rowCount() > 0) {
                if (password_verify($password, $row['mypassword'])) {
                    // header("Location: index.php");

                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['id'];

                    header('Location: http://localhost/clean-blog/index.php');
                    
                    //echo "YOU ARE LOGGED IN";
                }
            }
        }
    }
?>

               <form method="POST" action="login.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
                    

                   
                  </div>
                </form>

<?php require "../includes/footer.php"; ?>

 