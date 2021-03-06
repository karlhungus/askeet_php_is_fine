<?php

class myUser extends sfBasicSecurityUser
{
	public function signIn($user)
	{
		$this->setAttribute('subscriber_id', $user->getId(), 'subscriber');
		$this->setAuthenticated(true);

		$this->addCredential('subscriber');
		$this->setAttribute('nickname', $user->getNickname(), 'subscriber');
	}

	public function signOut()
	{
		$this->getAttributeHolder()->removeNamespace('subscriber');

		$this->setAuthenticated(false);
		$this->clearCredentials();
	}

	public function getSubscriberId()
	{
		return $this->getAttribute('subscriber_id', '', 'subscriber');
	}

	public function getSubscriber()
	{
		return Doctrine_Query::create()
							->from('User')
							->where('id = ?', $this->getSubscriberId())
							->execute()
							->getFirst();
	}

	public function getNickname()
	{
		return $this->getAttribute('nickname', '', 'subscriber');
	}
}
