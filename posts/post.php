<?php require "../includes/navbar.php"; ?>
<?php require "../config/config.php"; ?>


<?php 
if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];

    $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $select->execute([':id' => $id]);
    
    $post = $select->fetch(PDO::FETCH_OBJ);   
    } else {
        echo "404";
    }
?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('images/<?php echo $post->img; ?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1> <?php echo $post->title; ?> </h1>
                            <h2 class="subheading"> <?php echo $post->subtitle; ?> </h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"> <?php echo $post->user_name; ?> </a>
                                <!-- <?php  echo date('M', strtotime($post->user_name)) . ',' . date('d', strtotime($post->user_namet)) . ' ' . date('Y', strtotime($post->user_name));  ?> -->
                                 <?php  echo date('M, d Y', strtotime($post->created_at)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        
                        <p> <?php echo $post->body; ?> </p>
                        <!-- <p>
                            Placeholder text by
                            <a href="http://spaceipsum.com/">Space Ipsum</a>
                            &middot; Images by
                            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                        </p> -->
                    </div>
                </div>
            </div>
        </article>
    <?php require "../includes/footer.php"; ?>

        <!-- Footer-->
        <!-- <footer class="border-top"> 
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </div>
        </footer>
         //Bootstrap core JS
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        //Core theme JS
        <script src="../js/scripts.js"></script>
    </body>
</html> -->
