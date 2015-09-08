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

abstract class GitRepo extends Git
{
    private $json_array = null;
    protected $username = null;

    public function __construct($user, $json_array)
    {
        $this->username   = $user;
        $this->json_array = $json_array;
    }

    public function __get($name)
    {
        if (isset($this->$name))
        {
            return $this->$name;
        }

        if (isset($this->json_array[$name]))
        {
            return $this->json_array[$name];
        }

        $method = 'get'.ucfirst($name);
        if (method_exists($this, $method))
        {
            $this->$name = $this->$method();
            return $this->$name;
        }

        return null;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * Get GitHub Repository README
     *
     * @return  String  README Text
     *          boolean false on error
     */
    protected abstract function getReadme();

    /**
     * Get GitHub Repository programming langiage
     *
     * @return  String  Repository Programming language
     *          boolean false on error or then no programming language found
     */
    protected abstract function getProgrammingLanguage();

    /**
     * Get GitHub Repository Runtime platform
     *
     * @return  String  Repository Runtime platform
     *          boolean false on error or then no programming language found
     */
    protected abstract function getRuntimePlatform();

}