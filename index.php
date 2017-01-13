<?php
/**
 * User: mdacosta
 * Date: 1/13/17
 * Time: 19:34
 */

session_start();

if (!isset( $_SESSION['favourites'])) { $_SESSION['favourites'] = []; }

function is_favourite($id) {
  return in_array($id, $_SESSION['favourites']);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Asynchronous Button</title>
    <style>
      #blog-posts {
        width: 700px;
      }
      .blog-post {
        border: 1px solid black;
        margin: 10px 10px 20px 10px;
        padding: 6px 10px;
      }

      button.favorite-button, button.unfavorite-button {
        background: #0000FF;
        color: white;
        text-align: center;
        width: 70px;
      }
      button.favorite-button:hover, button.unfavorite-button:hover {
        background: #000099;
      }
      .favourite-heart {
        font: 2em;
        color: red;
        display: none;
        float: right;
      }
      .favourite .favourite-heart {
        display: block;
      }

    </style>
  </head>
  <body>
    <?php // echo join(', ', $_SESSION['favourites']); ?>
    <div id="blog-posts">
      <div id="blog-post-101" class="blog-post <?php if(is_favourite(101)){echo 'favourite';}?>">
        <span class="favourite-heart">&hearts;</span>
        <h3>Blog Post 101</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque nunc malesuada mauris fermentum commodo. Integer non pellentesque augue, vitae pellentesque tortor. Ut gravida ullamcorper dolor, ac fringilla mauris interdum id. Nulla porta egestas nisi, et eleifend nisl tincidunt suscipit. Suspendisse massa ex, fringilla quis orci a, rhoncus porta nulla. Aliquam diam velit, bibendum sit amet suscipit eget, mollis in purus. Sed mattis ultricies scelerisque. Integer ligula magna, feugiat non purus eget, pharetra volutpat orci. Duis gravida neque erat, nec venenatis dui dictum vel. Maecenas molestie tortor nec justo porttitor, in sagittis libero consequat. Maecenas finibus porttitor nisl vitae tincidunt.</p>
        <button class="favorite-button">Like</button>
        <button class="unfavorite-button">UnLike</button>
      </div>
      <div id="blog-post-102" class="blog-post <?php if(is_favourite(102)){echo 'favourite';}?>">
        <span class="favourite-heart">&hearts;</span>
        <h3>Blog Post 102</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque nunc malesuada mauris fermentum commodo. Integer non pellentesque augue, vitae pellentesque tortor. Ut gravida ullamcorper dolor, ac fringilla mauris interdum id. Nulla porta egestas nisi, et eleifend nisl tincidunt suscipit. Suspendisse massa ex, fringilla quis orci a, rhoncus porta nulla. Aliquam diam velit, bibendum sit amet suscipit eget, mollis in purus. Sed mattis ultricies scelerisque. Integer ligula magna, feugiat non purus eget, pharetra volutpat orci. Duis gravida neque erat, nec venenatis dui dictum vel. Maecenas molestie tortor nec justo porttitor, in sagittis libero consequat. Maecenas finibus porttitor nisl vitae tincidunt.</p>
        <button class="favorite-button">Like</button>
        <button class="unfavorite-button">UnLike</button>
      </div>
      <div id="blog-post-103" class="blog-post <?php if(is_favourite(103)){echo 'favourite';}?>">
        <span class="favourite-heart">&hearts;</span>
        <h3>Blog Post 103</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque nunc malesuada mauris fermentum commodo. Integer non pellentesque augue, vitae pellentesque tortor. Ut gravida ullamcorper dolor, ac fringilla mauris interdum id. Nulla porta egestas nisi, et eleifend nisl tincidunt suscipit. Suspendisse massa ex, fringilla quis orci a, rhoncus porta nulla. Aliquam diam velit, bibendum sit amet suscipit eget, mollis in purus. Sed mattis ultricies scelerisque. Integer ligula magna, feugiat non purus eget, pharetra volutpat orci. Duis gravida neque erat, nec venenatis dui dictum vel. Maecenas molestie tortor nec justo porttitor, in sagittis libero consequat. Maecenas finibus porttitor nisl vitae tincidunt.</p>
        <button class="favorite-button">Like</button>
        <button class="unfavorite-button">UnLike</button>
      </div>
    </div>

    <script>
      function favorite() {
        var parent = this.parentElement;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'favourite.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
          if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
            if(result == 'true') {
              parent.classList.add('favourite');
            }
          }
        };
        xhr.send("id=" + parent.id);
      }

      var buttons = document.getElementsByClassName("favorite-button");
      for(i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", favorite);
      }

      function unfavorite() {
        var parent = this.parentElement;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'unlike.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
          if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
            if(result == 'true') {
              parent.classList.remove('favourite');
            }
          }
        };
        xhr.send("id=" + parent.id);
      }

      var buttons = document.getElementsByClassName("unfavorite-button");
      for(i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", unfavorite);
      }

    </script>

  </body>
</html>
