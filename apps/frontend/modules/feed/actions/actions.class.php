<?php

/**
 * feed actions.
 *
 * @package    askeet
 * @subpackage feed
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class feedActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}

	public function executePopular()
	{
		// questions
		$per_page = sfConfig::get('app_feed_max');
		$questions = Doctrine_Query::create()
							->from('Question q, q.User u')
							->orderBy('q.interested_users DESC')
							->limit($per_page)
							->execute();
		
		
		$feed = new sfRss201Feed();
		
		$feed->initialize(array(
    		'title'       => 'Askeet',
    		'link'        => 'http://askeet.loc/',
    		'authorEmail' => 'Levan@Askeet.loc',
    		'authorName'  => 'Levan K'
  		));
  		
  		foreach ($questions as $post)
  		{
    		$item = new sfFeedItem();
    		$item->initialize(array(
      			'title'       => $post->getTitle(),
      			'link'        => '@question?stripped_title='.$post->getStrippedTitle(),
      			'authorName'  => $post->getUser()->getFirstName(),
      			'authorEmail' => $post->getUser()->getEmail(),
      			#'pubDate'     => $post->getCreatedAt(),
      			'uniqueId'    => $post->getStrippedTitle(),
      			'description' => $post->getHtmlBody(),
    		));

    		$feed->addItem($item);
  		}
  		
  		$this->feed = $feed;
  		
  		
	}
}
