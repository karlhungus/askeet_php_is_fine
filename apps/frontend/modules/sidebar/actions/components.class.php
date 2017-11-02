<?php 
 
class sidebarComponents extends sfComponents
{
  public function executeDefault()
  {
  }
  
  public function executeQuestion()
  {
  	$this->question = Question::getQuestionFromTitle($this->getRequestParameter('stripped_title'));
  }
}
