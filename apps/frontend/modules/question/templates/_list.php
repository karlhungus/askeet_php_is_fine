<?php use_helper('Text', 'Global', 'Date', 'Question') ?>

<?php foreach($question_pager->getResults() as $question): ?>
  <div class="question">
    <div class="interested_block" id="block_<?php echo $question->getId() ?>">
      <?php include_partial('question/interested_user', array('question' => $question)) ?>
    </div>
 
    <h2><?php echo link_to($question->getTitle(), 'question/show?stripped_title='.$question->getStrippedTitle()) ?></h2>
 
 	<div>asked by <?php echo link_to($question->getUser(), 'user/show?nickname='.$question->getUser()->getNickname()) ?> on <?php echo format_date($question->getCreatedAt(), 'f') ?></div>
    <div class="question_body">
      <?php echo truncate_text($question->getHtmlBody(), 200) ?>
    </div>
    
    tags: <?php echo tags_for_question($question) ?>
    
  </div>
<?php endforeach; ?>

<div id="question_pager">
	<?php echo pager_navigation($question_pager, $rule) ?>
</div>