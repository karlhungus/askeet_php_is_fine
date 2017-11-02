<?php use_helper('Date') ?>
  <div class="answer">
    <?php echo $answer->getRelevancys() ?>
    posted by <?php echo link_to($answer->getUser(), 'user/show?nickname='.$answer->getUser()->getNickname()) ?> 
    on <?php echo format_date($answer->getCreatedAt(), 'p') ?>
    <div>
      <?php echo $answer->getHtmlBody() ?>
    </div>
  </div>