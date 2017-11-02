<?php echo link_to('ask a new question', 'question/add') ?>
 
<ul>
  <li><?php echo link_to('popular questions', '@popular_questions') ?> <?php echo link_to_feed('popular questions', '@feed_popular_questions') ?></li>
  <li><?php echo link_to('latest questions', 'question/recent') ?></li>
  <li><?php echo link_to('latest answers', 'answer/recent') ?></li>
  <li><?php echo link_to('popular tags', '@popular_tags') ?></li>
</ul>