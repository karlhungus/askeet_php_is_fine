<?php

/**
 * UserTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UserTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return UserTable The table instance
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('User');
    }
}