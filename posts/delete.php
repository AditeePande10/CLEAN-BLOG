<?php require "../includes/navbar.php"; ?>

<?php require "../config/config.php"; ?>


<?php

    if(isset($_GET['del_id'])) {
        $id = $_GET['del_id'];

        $select = $conn->prepare("SELECT * FROM posts WHERE id = :id"); 
        $select->execute([':id' => $id]);
        $post = $select->fetch(PDO::FETCH_OBJ);


        if ($_SESSION['user_id'] !== $post->user_id) {
            header("location: http://localhost/clean-blog/index.php");
            exit();
        } else {     
            unlink("images/" . $post->img . "");


        $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
        $delete->execute([
            ':id' => $id
        ]);


    } 
    }
    else {
        header("Location: http://localhost/clean-blog/index.php");

}
?>
