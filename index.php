<?php
$path = realpath(dirname(__FILE__));
include $path . '/layout/head.php';
?>

<body>

  <!-- ***** Preloader Start ***** -->
  <!-- <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   -->
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <?php include $path . '/layout/navbar.php'; ?>

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <?php include $path . '/banner.php'; ?>
  <!-- Banner Ends Here -->



  <section class="blog-posts">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">
              <?php
              $sql = "SELECT post.*,admin.name as Author,category.name as Category FROM post INNER JOIN admin ON post.admin_id=admin.id 
JOIN category ON post.category_id=category.id 
ORDER BY post.id DESC LIMIT 3";
              $stmt = $pdo->query($sql);
              $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

              if ($posts != null) {
                foreach ($posts as $post) { ?>
                  <div class="col-lg-12">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="admin/<?php echo $post->image; ?>" alt="">
                      </div>
                      <div class="down-content">
                        <span><?php echo $post->Category; ?></span>
                        <a href="post-details.html">
                          <h4><?php echo $post->title; ?></h4>
                        </a>
                        <ul class="post-info">
                          <li><a href="#"><?php echo $post->Author; ?></a></li>
                          <li><a href="#"> <?php
                          $dateCreate = date_create($post->created_at);
                          echo $dateCreate->format('M d, Y');
                          ?>
                            </a></li>
                        </ul>
                        <div>
                          <?php echo html_entity_decode(str_limit($post->description,800)); ?>
                        </div>
                        <div class="post-options">
                          <div class="row">
                            <div class="col-6">
                              <ul class="post-tags mt-3">
                                <li><i class="fa fa-tags"></i></li>
                                <?php
                                $sql = "SELECT tag.* FROM tag INNER JOIN post_tag ON tag.id = post_tag.tag_id WHERE post_id=:postId";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':postId', $post->id, PDO::PARAM_INT);
                                $stmt->execute();
                                $tags = $stmt->fetchAll(PDO::FETCH_OBJ);
                                if ($tags) {
                                    foreach ($tags as $key => $tag) { ?>                                       
                                        <li><a href="#"><?php echo $tag->name; ?></a>,</li>
                                        <?php
                                    }
                                }
                                ?>
                              </ul>
                            </div>
                            <div class="col-6">

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }
              }
              ?>


              <div class="col-lg-12">
                <div class="main-button">
                  <a href="blog.php">View All Posts</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- home page sidebar -->
          <?php include $path . '/home_sidebar.php'; ?>
        </div>
      </div>
    </div>
  </section>


  <!-- footer and script -->
  <?php include $path . '/layout/footer.php'; ?>
</body>

</html>