<?php 
require "../includes/header.php";
require "../config/config.php"; 

// ✅ Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];

    // ✅ Use prepared statement (more secure)
    $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $select->execute([':id' => $id]);
    $rows = $select->fetch(PDO::FETCH_OBJ);

    if (!$rows) {
        header("Location: http://localhost/clean-blog/index.php");
        exit();
    }

    // ✅ Verify post ownership
    if ($_SESSION['user_id'] != $rows->user_id) {
        header("Location: http://localhost/clean-blog/index.php");
        exit();
    }

    // ✅ Handle form submission
    if (isset($_POST['submit'])) {
        if (empty($_POST['title']) || empty($_POST['subtitle']) || empty($_POST['body'])) {
            echo "One or more inputs are empty";
        } else {
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];

            // Handle image
            if (!empty($_FILES['img']['name'])) {
                // delete old image if exists
                if (!empty($rows->img) && file_exists("images/" . $rows->img)) {
                    unlink("images/" . $rows->img);
                }

                $img = $_FILES['img']['name'];
                $dir = 'images/' . basename($img);
                move_uploaded_file($_FILES['img']['tmp_name'], $dir);
            } else {
                $img = $rows->img; // ✅ keep old image if new not uploaded
            }

            // ✅ Update query
            $update = $conn->prepare("UPDATE posts 
                SET title = :title, subtitle = :subtitle, body = :body, img = :img 
                WHERE id = :id");
            
            $update->execute([
                ':title' => $title,
                ':subtitle' => $subtitle,
                ':body' => $body,
                ':img' => $img,
                ':id' => $id
            ]);

            header("Location: http://localhost/clean-blog/index.php");
            exit();
        }
    }
}
?>

<form method="POST" action="update.php?upd_id=<?php echo $id; ?>" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <input type="text" name="title" value="<?php echo $rows->title; ?>" class="form-control" placeholder="title" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" value="<?php echo $rows->subtitle; ?>" class="form-control" placeholder="subtitle" />
    </div>

    <div class="form-outline mb-4">
        <textarea name="body" class="form-control" placeholder="body" rows="8"><?php echo $rows->body; ?></textarea>
    </div>

    <?php echo "<img src='images/" . $rows->img . "' width=900 height=300>"; ?>

    <div class="form-outline mb-4">
        <input type="file" name="img" class="form-control" />
    </div>

    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Update</button>
</form>

<?php require "../includes/footer.php"; ?>