<?php

/**
 * BaseInterest
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int       $question_id               Type: integer
 * @property int       $user_id                   Type: integer
 * @property Question  $Question                  
 * @property User      $User                      
 *  
 * @method int         getQuestionId()            Type: integer
 * @method int         getUserId()                Type: integer
 * @method Question    getQuestion()              
 * @method User        getUser()                  
 *  
 * @method Interest    setQuestionId(int $val)    Type: integer
 * @method Interest    setUserId(int $val)        Type: integer
 * @method Interest    setQuestion(Question $val) 
 * @method Interest    setUser(User $val)         
 *  
 * @package    project_example
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInterest extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ask_interest');
        $this->hasColumn('question_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Question', array(
             'local' => 'question_id',
             'foreign' => 'id'));

        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'created_at' => 
             array(
              'name' => 'created_at',
              'type' => 'timestamp',
              'options' => 
              array(
              ),
             ),
             ));
        $this->actAs($timestampable0);
    }
}