<?php

/**
 * user actions.
 *
 * @package    askeet
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class userActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}

	public function handleErrorLogin()
	{
		return sfView::SUCCESS;
	}

	public function executeLogin()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// display the form
			$this->getRequest()->getParameterHolder()->set('referer', $this->getRequest()->getReferer());

			return sfView::SUCCESS;
		}
		else
		{
			// handle the form submission
			// redirect to last page
			return $this->redirect($this->getRequestParameter('referer', '@homepage'));
		}
	}

	public function executeLogout()
	{
		$this->getUser()->signOut();

		$this->redirect('@homepage');
	}


	public function executeShow()
	{
		#$this->subscriber = Doctrine::getTable('User')->find($this->getRequestParameter('id', $this->getUser()->getSubscriberId()));
		$this->subscriber = Doctrine_Query::create()
		->from('User u, u.Questions q, u.Interests ui, ui.Question, u.Answers ua, ua.Question')
		->where('u.nickname = ?', $this->getRequestParameter('nickname'))
		->execute()->getFirst();

		$this->forward404Unless($this->subscriber);

		$this->questions = $this->subscriber->getQuestions();

		$this->interests = $this->subscriber->getInterests();

		$this->answers   = $this->subscriber->getAnswers();

	}


	public function executeInterested()
	{
		$this->question = Doctrine::getTable('Question')->find($this->getRequestParameter('id'));
		$this->forward404Unless($this->question);

		$user = $this->getUser()->getSubscriber();

		$interest = new Interest();
		$interest->setQuestion($this->question);
		$interest->setUser($user);
		$interest->save();
	}

	public function handleErrorPasswordRequest()
	{
		return sfView::SUCCESS;
	}

	public function executePasswordRequest()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// display the form
			return sfView::SUCCESS;
		}

		// handle the form submission
		$user = Doctrine::getTable('User')->findOneByEmail($this->getRequestParameter('email'));
		
		// email exists?
		if ($user)
		{
			// set new random password
			$password = substr(md5(rand(100000, 999999)), 0, 6);
			$user->setPassword($password);

			$this->getRequest()->setAttribute('password', $password);
			$this->getRequest()->setAttribute('nickname', $user->getNickname());

			$raw_email = $this->sendEmail('mail', 'sendPassword');
			#$this->logMessage($raw_email, 'debug');

			// save new password
			$user->save();

			return 'MailSent';
		}
		else
		{
			$this->getRequest()->setError('email', 'There is no askeet user with this email address. Please try again');

			return sfView::SUCCESS;
		}
	}
}
