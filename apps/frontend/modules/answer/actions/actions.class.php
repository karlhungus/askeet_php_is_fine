<?php

/**
 * answer actions.
 *
 * @package    askeet
 * @subpackage answer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class answerActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}

	public function executeRecent()
	{
		$this->answer_pager = Answer::getRecentPager($this->getRequestParameter('page', 1));
	}

	public function executeAdd()
	{
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
			if (!$this->getRequestParameter('body'))
			{
				return sfView::NONE;
			}

			$question = Doctrine::getTable('Question')->find($this->getRequestParameter('question_id'));
			$this->forward404Unless($question);

			// user or anonymous coward
			$user = $this->getUser()->isAuthenticated() ? $this->getUser()->getSubscriber() : User::retrieveByNickname('anonymous');

			// create answer
			$this->answer = new Answer();
			$this->answer->setQuestion($question);
			$this->answer->setBody($this->getRequestParameter('body'));
			$this->answer->setUser($user);
			$this->answer->save();

			return sfView::SUCCESS;
		}

		$this->forward404();
	}

}
