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

JLoader::register('GitRepos', __DIR__ . DIRECTORY_SEPARATOR . 'gitrepos.php');
JLoader::register('GitRepo_github', __DIR__ . DIRECTORY_SEPARATOR . 'gitrepo_github.php');

class GitRepos_github extends GitRepos
{

    /**
     * Get GitHub Repositories sorted by activation date
     *
     * @param    String $user repository user name
     * @param   \Joomla\Registry\Registry $params module parameters
     *
     * @return  array   The array of GitRepo
     *          boolean false on error
     */
    protected function getRepos($user, $params)
    {
        // Initialize the array
        $github = array();

        $req = 'https://api.github.com/users/' . $user . '/repos';

        // Fetch the decoded JSON
        $objs = self::getJSON($req);

        if (is_null($objs))
        {
            return false;
        }

        if (isset($objs['message']))
        {
            $error_des = $objs['message'];
            $error_url = $objs['documentation_url'];
            //an error occurred
            return false;
        }

        //Process the filtering options and render the feed
        foreach ($objs as $obj)
        {
            if (!$obj['fork'])
            {
                $github[] = new GitRepo_github($user, $obj);
            }
        }

        return $github;
    }
}