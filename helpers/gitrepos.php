<?php
/**
 * @package     Joomla.Module
 * @subpackage  mod_forkmeon
 * @version     0.0.1
 *
 * @copyright   Copyright (C) 2015 LadyjJ (Mariella Colombo) All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

JLoader::register('Git', __DIR__ . DIRECTORY_SEPARATOR . 'git.php');

abstract class GitRepos extends Git implements Iterator
{
    private   $gitRepos = array();
    protected $errorMsg = "";

    /**
     * Get GitHub Repositories sorted by activation date
     *
     * @param    String $user repository user name
     * @param   \Joomla\Registry\Registry $params module parameters
     *
     * @return  array   The array of repositories
     *          boolean false on error
     */
    protected abstract function getRepos($user, $params);

    public function __construct($user, $params)
    {
        $ret = $this->getRepos($user, $params);
        if (is_array($ret))
        {
            $this->gitRepos = $ret;
        }
        else
        {
            $this->errorMsg = "Unable to load GIT repos";
        }
    }

    public function isEmpty()
    {
       return empty($this->gitRepos);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $var = current($this->gitRepos);
        return $var;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $var = next($this->gitRepos);
        return $var;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        $var = key($this->gitRepos);
        return $var;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $key = key($this->gitRepos);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        reset($this->gitRepos);
    }
}