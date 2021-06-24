<!DOCTYPE html>
<html lang="en" class="clearfix">
<head>
   <title>Blog - Yourstruly, HB</title>
   <link rel="icon" href="assets/images/favicon.png">
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="assets/css/style.css">

   <!-- Font awesome -->
   <script src="https://kit.fontawesome.com/220d6b62fe.js" crossorigin="anonymous"></script>

   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Didact+Gothic&family=Fjalla+One&display=swap" rel="stylesheet">
</head>

<?php
// Connect to database
include 'components/DBConnector.php';

$searchTerm = NULL;
$topicID = NULL;

// Check if query is defined
if (isset($_GET['query']) and trim($_GET['query']) != '') {
   $searchTerm = $_GET['query'];

   // If query starts with "topic:" user has chosen to see blogs related to a topic
   if (str_starts_with($searchTerm, "topic:")) {

      // Trim search term to get topic name
      $searchTerm = ltrim($searchTerm, "topic:");

      // Get topic ID by given topic name
      $topicIDQuery = "SELECT `id` FROM `topics` WHERE `name` = '$searchTerm' LIMIT 1;";
      $topicIDRes = $conn->query($topicIDQuery);
      $id = $topicIDRes->fetch_assoc();
      // Set topicID value
      $topicID = $id['id'];
   }
}

// READ FROM DATABASE
$posts = NULL;

// if topic ID is set, get posts with topic_id similar to established topic_id
if (isset($topicID)) {
   $posts_query = "SELECT * FROM `posts` AS P,`users` AS U WHERE P.user_id = U.id and `topic_id` = '$topicID' ORDER BY publishDate DESC;";
   $posts = $conn->query($posts_query);

   // If topic_id not specified and search term is specified, find posts where search term can be found in author's name, post title, and content
} elseif (isset($searchTerm)) {
   $posts_query = "SELECT * FROM `posts` AS P,`users` AS U WHERE P.user_id = U.id and (`title` LIKE '%$searchTerm%' OR `body` LIKE '%$searchTerm%' OR U.username LIKE '%$searchTerm%') ORDER BY publishDate DESC;";
   $posts = $conn->query($posts_query);

   // If topicID and searchTerm unspecified, select 10 recent posts from the database
} else {
   $posts_query =
      "SELECT * FROM `posts` AS P,`users` AS U WHERE P.user_id = U.id ORDER BY publishDate DESC LIMIT 10;";
   $posts = $conn->query($posts_query);
}
?>

<body>
   <!-- Navigation bar -->
   <?php include 'components/header_nav.php'; ?>

   <!-- Search bar -->
   <form id="searchForm" name="searchForm" class="wrapper-search-bar" action='index.php' method='get'>
      <div class="search-bar">
         <input type="search" name="query" placeholder="Search blog title" class="search-term" id="search-box">
         <button type="button" class="btn" id="search-button" onclick=submitSearch()>
            <i class="fa fa-search"></i>
         </button>
      </div>
   </form>

   <!-- Topics Dropdown -->
   <div class="wrapper-topics-dropdown">
      <div class="dropdownbox">
         <p>Search by topic</p>
      </div>
      <ul class="menu">
         <?php include 'components/topics.php';
         while ($topic = $topicsResult->fetch_assoc()) { ?>
            <li><?php echo $topic['name']; ?></li>
         <?php } ?>
      </ul>
   </div>

   <!-- Content -->
   <div class="content clearfix">
      <!-- Main Content-->
      <div class="main-content">
         <h1 class="recent-post-title" id="current-blogs">
            <?php if (isset($searchTerm) and $posts == true and mysqli_num_rows($posts) > 0) {
               echo "You searched for: " . "<i>'" . $searchTerm . "'</i>";
            } elseif (isset($searchTerm) and $posts == true and mysqli_num_rows($posts) == 0) {
               echo "No blogs related to: " . "<i>'" . $searchTerm . "'</i>";
            } else {
               echo "Recent blogs";
            } ?>
         </h1>

         <!-- Posts -->
         <?php
         if ($posts and mysqli_num_rows($posts) > 0) {
            while ($post = $posts->fetch_assoc()) { ?>

               <div class="blog-post">
                  <div class="blog-image-holder clearfix">
                     <img src=<?php echo $post['image']; ?> alt="" class="post-image">
                  </div>
                  <div class="blog-title">
                     <h2><a href="#"><?php echo $post['title']; ?></a></h2>
                  </div>
                  <div class="blog-metadata">
                     <i class="far fa-user"></i>
                     &nbsp;
                     <span class="author"><?php echo $post['username']; ?></span>
                     &nbsp; &nbsp; &nbsp;
                     <i class="far fa-calendar-alt"></i>
                     &nbsp;
                     <span class="publish-date"><?php echo date('F j, Y', strtotime($post['publishDate'])); ?></span>
                  </div>

                  <div class="blog-preview">
                     <p class="preview-text">
                        <?php echo html_entity_decode(substr($post['body'], 0, 510) . '...'); ?>
                     </p>
                  </div>
                  <a href="#" class="btn" id="read-more-btn">Read more</a>
               </div>
            <?php
            }
         } else { ?>
            <div style="height: 250px;"></div>
         <?php } ?>
      </div>
   </div>

   <!-- Footer -->
   <footer>
      <div class="footer-content">
         <!-- About -->
         <div class="about">
            <h1 class="logo-text">Yourstruly, HB</h1>
            <p><strong>Yourstruly, HB</strong> is a website designed by Hannah Bella C. Arceño for an academic project.</p>
            <div class="contact">
               <i class="fas fa-phone"></i> &nbsp; +639 163 010 790<br>
               <i class="fas fa-envelope"></i> &nbsp; yourstrulyhb@gmail.com</span>
            </div>
            <div class="socials">
               <a href="#"><i class="fab fa-facebook"></i></a>
               <a href="#"><i class="fab fa-instagram"></i></a>
               <a href="#"><i class="fab fa-twitter"></i></a>
               <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
         </div>

         <!-- Quick Links -->
         <div class="links">
            <h2>Site Pages</h2>
            <ul>
               <li><a href="#">Home</a></li>
               <li><a href="#">About</a></li>
               <li><a href="blog.html">Blog</a></li>
               <li><a href="#">Contact</a></li>
            </ul>
         </div>

         <!-- Contact Form -->
         <?php include 'components/feedback.php'; ?>
      </div>

      <div class="footer-bottom">
         &copy; 2021 yourstrulyhb.com | designed by Hannah Bella C. Arceño
      </div>
   </footer>
   <!-- Footer -->

   <!-- JQuery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

   <!-- Custom JS -->
   <script src='assets/js/responseScripts.js'></script>

</body>
</html>