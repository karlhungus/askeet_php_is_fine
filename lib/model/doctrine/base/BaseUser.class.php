<?php

/**
 * BaseUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                                $id                                       Type: integer, primary key
 * @property string                             $nickname                                 Type: string(30)
 * @property string                             $first_name                               Type: string(50)
 * @property string                             $last_name                                Type: string(50)
 * @property string                             $email                                    Type: string(100)
 * @property string                             $sha1_password                            Type: string(40)
 * @property string                             $salt                                     Type: string(32)
 * @property Doctrine_Collection|Question[]     $Questions                                
 * @property Doctrine_Collection|Answer[]       $Answers                                  
 * @property Doctrine_Collection|Interest[]     $Interests                                
 * @property Doctrine_Collection|QuestionTag[]  $QuestionTags                             
 *  
 * @method int                                  getId()                                   Type: integer, primary key
 * @method string                               getNickname()                             Type: string(30)
 * @method string                               getFirstName()                            Type: string(50)
 * @method string                               getLastName()                             Type: string(50)
 * @method string                               getEmail()                                Type: string(100)
 * @method string                               getSha1Password()                         Type: string(40)
 * @method string                               getSalt()                                 Type: string(32)
 * @method Doctrine_Collection|Question[]       getQuestions()                            
 * @method Doctrine_Collection|Answer[]         getAnswers()                              
 * @method Doctrine_Collection|Interest[]       getInterests()                            
 * @method Doctrine_Collection|QuestionTag[]    getQuestionTags()                         
 *  
 * @method User                                 setId(int $val)                           Type: integer, primary key
 * @method User                                 setNickname(string $val)                  Type: string(30)
 * @method User                                 setFirstName(string $val)                 Type: string(50)
 * @method User                                 setLastName(string $val)                  Type: string(50)
 * @method User                                 setEmail(string $val)                     Type: string(100)
 * @method User                                 setSha1Password(string $val)              Type: string(40)
 * @method User                                 setSalt(string $val)                      Type: string(32)
 * @method User                                 setQuestions(Doctrine_Collection $val)    
 * @method User                                 setAnswers(Doctrine_Collection $val)      
 * @method User                                 setInterests(Doctrine_Collection $val)    
 * @method User                                 setQuestionTags(Doctrine_Collection $val) 
 *  
 * @package    project_example
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ask_user');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nickname', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('first_name', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('last_name', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('sha1_password', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('salt', 'string', 32, array(
             'type' => 'string',
             'length' => 32,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Question as Questions', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('Answer as Answers', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('Interest as Interests', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('QuestionTag as QuestionTags', array(
             'local' => 'id',
             'foreign' => 'user_id'));

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