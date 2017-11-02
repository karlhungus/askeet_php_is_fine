<?php

/**
 * api actions.
 *
 * @package    askeet
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class apiActions extends sfActions
{
	public function preExecute()
	{
		sfConfig::set('sf_web_debug', false);
	}
	
	public function executeIndex()
	{
		$user = $this->authenticateUser();
		if (!$user)
		{
			$this->error_code    = 1;
			$this->error_message = 'login failed';

			$this->forward('api', 'error');
		}
		// do some stuff
	}

	private function authenticateUser()
	{
		if (isset($_SERVER['PHP_AUTH_USER']))
		{
			if ($user = User::getAuthenticatedUser($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
			{
				$this->getContext()->getUser()->signIn($user);

				return $user;
			}
		}

		header('WWW-Authenticate: Basic realm="askeet API"');
		header('HTTP/1.0 401 Unauthorized');
	}
	
	public function executeError()
	{
	}
	
	public function executeQuestion()
	{
		$user = $this->authenticateUser();
		
		if (!$user)
		{
			$this->error_code    = 1;
			$this->error_message = 'login failed';

			$this->forward('api', 'error');
		}

		if (!$this->getRequestParameter('stripped_title'))
		{
			$this->error_code    = 2;
			$this->error_message = 'The API returns answers to a specific question. Please provide a stripped_title parameter';

			$this->forward('api', 'error');
		}
		else
		{
			// get the question
			$question = Question::getQuestionFromTitle($this->getRequestParameter('stripped_title'));

			if ($question->getUserId() != $user->getId())
			{
				$this->error_code    = 3;
				$this->error_message = 'You can only use the API for the questions you asked';

				$this->forward('api', 'error');
			}
			else
			{
				// get the answers
				$this->answers  = $question->getAnswers();
				$this->question = $question;
			}
		}
	}
}
