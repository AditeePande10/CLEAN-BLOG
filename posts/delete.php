<?php 
require "../includes/navbar.php"; 
require "../config/config.php"; 

// ✅ Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];

    // Select the post
    $select = $conn->prepare("SELECT * FROM posts WHERE id = :id"); 
    $select->execute([':id' => $id]);
    $post = $select->fetch(PDO::FETCH_OBJ);

    // ✅ Check if post exists first
    if (!$post) {
        header("Location: http://localhost/clean-blog/index.php");
        exit();
    }

    // ✅ Check ownership
    if ($_SESSION['user_id'] != $post->user_id) {
        header("Location: http://localhost/clean-blog/index.php");
        exit();
    } else {     
        // ✅ Delete image only if it exists
        if (!empty($post->img) && file_exists("images/" . $post->img)) {
            unlink("images/" . $post->img);
        }

        // Delete post
        $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
        $delete->execute([':id' => $id]);
    }
}

header("Location: http://localhost/clean-blog/index.php");
exit();
?>