<?php
/**
 * @package     Joomla.Module
 * @subpackage  mod_forkmeon
 *
 * @author      Mariella Colombo (aka Ladyj) <mariella.colombo@ladyj.eu>
 * @link        http://www.ladyj.eu
 * @copyright   Copyright (C) 2015 Mariella Colombo All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

JLoader::register('GitRepo',__DIR__ . DIRECTORY_SEPARATOR . 'gitrepo.php');

class GitRepo_github extends GitRepo
{
    /**
     * Get GitHub Repository README
     *
     * @return  String  README Text
     *          boolean false on error
     */
    protected function getReadme()
    {
        // Initialize the array
        $github = array();

        $req = "https://api.github.com/repos/{$this->username}/{$this->name}/readme";

        // Fetch the decoded JSON
        $obj = self::getJSON($req);

        if (is_null($obj))
        {
            return false;
        }

        $readme = $obj['content'];
        if (@$obj['encoding'] == 'base64')
        {
            $readme = base64_decode($readme);
        }

        return $readme;
    }

    /**
     * Get GitHub Repository programming langiage
     *
     * @return  String  Repository Programming language
     *          boolean false on error or then no programming language found
     */
    protected function getProgrammingLanguage()
    {
        /*
         * RegExp
         *
         * String PROGRAMMIN LANGUAGE
         * followed by new line \n
         * Any character sequence (.*?)
         * followed by another new line (\n) or end of file ($)
         * /si case insensitive
         */
        if (preg_match('/PROGRAMMING LANGUAGE\n(.*?)($|\n)/si', $this->readme, $match))
        {
            return $match[1];
        }

        return false;
    }

    /**
     * Get GitHub Repository Runtime platform
     *
     * @return  String  Repository Runtime platform
     *          boolean false on error or then no programming language found
     */
    protected function getRuntimePlatform()
    {
        /*
         * RegExp
         *
         * String RUNNING PLATFORM
         * followed by new line \n
         * Any character sequence (.*?)
         * followed by another new line (\n) or end of file ($)
         * /si case insensitive
         */
        if (preg_match('/RUNTIME PLATFORM\n(.*?)($|\n)/si', $this->readme, $match))
        {
            return $match[1];
        }

        return false;
    }
}