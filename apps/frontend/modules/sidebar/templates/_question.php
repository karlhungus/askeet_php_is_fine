<?php include_partial('sidebar/default') ?>
 
<h2>question tags</h2>
 
<ul id="question_tags">
  <?php include_partial('tag/question_tags', array('question' => $question, 'tags' => $question->getTags())) ?> 
</ul>
<?php if ($sf_user->isAuthenticated()): ?>
  <div>Add your own:
    <?php echo form_remote_tag(array(
      'url'    => '@tag_add',
      'update' => 'question_tags',
    )) ?>
      <?php echo input_hidden_tag('question_id', $question->getId()) ?>
      <?php echo input_auto_complete_tag('tag', '', 'tag/autocomplete', 'autocomplete=on', 'use_style=true') ?>
      <?php echo submit_tag('Tag') ?>
    </form>
  </div>
<?php endif; ?>