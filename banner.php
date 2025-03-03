<?php
$sql = "SELECT post.*,admin.name as Author,category.name as Category FROM post INNER JOIN admin ON post.admin_id=admin.id 
JOIN category ON post.category_id=category.id 
WHERE post.is_featured=true
ORDER BY post.id DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<div class="main-banner header-text">
  <div class="container-fluid">
    <div class="owl-banner owl-carousel">
      <?php
      if ($posts != null) {
        foreach ($posts as $key => $post) { ?>
          <div class="item">
            <img src="admin/<?php echo $post->image;?>" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span><?php echo $post->Category; ?></span>
                </div>
                <a href="post-details.html">
                  <h4><?php echo $post->title; ?></h4>
                </a>
                <ul class="post-info">
                  <li><a href="#"><?php echo $post->Author; ?></a></li>
                  <li><a href="#">
                      <!-- May 12, 2020 -->
                      <?php
                      $dateCreate = date_create($post->created_at);
                      echo $dateCreate->format('M d, Y');
                      ?>

                    </a></li>
                </ul>
              </div>
            </div>
          </div>
        <?php }
      }
      ?>

    </div>
  </div>
</div>