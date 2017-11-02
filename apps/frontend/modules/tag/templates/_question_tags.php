<?php foreach($tags as $tag): ?>
  <li><?php echo link_to($tag['normalized_tag'], '@tag?tag='.$tag['normalized_tag'], 'rel=tag') ?></li>
<?php endforeach; ?>