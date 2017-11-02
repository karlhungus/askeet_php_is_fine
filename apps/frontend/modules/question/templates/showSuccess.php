<?php use_helper('Date') ?>
 
<div class="interested_block">
  <?php include_partial('interested_user', array('question' => $question)) ?>
</div>
 
<h2><?php echo $question->getTitle() ?></h2>
<div>asked by <?php echo link_to($question->getUser(), 'user/show?nickname='.$question->getUser()->getNickname()) ?> on <?php echo format_date($question->getCreatedAt(), 'f') ?></div>
<div class="question_body">
  <?php echo $question->getHtmlBody() ?>
</div>
 
<div id="answers">
<?php foreach ($question->getAnswers() as $answer): ?>
  <div class="answer">
  <?php include_partial('answer', array('answer' => $answer)) ?>
  </div>
<?php endforeach; ?>
 
<?php echo use_helper('User') ?>
 
<div class="answer" id="add_answer">
  <?php echo form_remote_tag(array(
    'url'      => '@add_answer',
    'update'   => array('success' => 'add_answer'),
    'loading'  => "Element.show('indicator')",
    'complete' => "Element.hide('indicator');".visual_effect('highlight', 'add_answer'),
  )) ?>
 
    <div class="form-row">
      <?php if ($sf_user->isAuthenticated()): ?>
        <?php echo $sf_user->getNickname() ?>
      <?php else: ?>
        <?php echo 'Anonymous Coward' ?>
        <?php echo link_to_login('login') ?>
      <?php endif; ?>
    </div>
 
    <div class="form-row">
      <label for="label">Your answer:</label>
      <?php echo textarea_tag('body', $sf_params->get('body')) ?>
    </div>
 
    <div class="submit-row">
      <?php echo input_hidden_tag('question_id', $question->getId()) ?>
      <?php echo submit_tag('answer it') ?>
    </div>
  </form>
</div>
 
</div>