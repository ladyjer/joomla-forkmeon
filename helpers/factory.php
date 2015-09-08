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

JLoader::register('GitRepos_github', __DIR__ . DIRECTORY_SEPARATOR . 'gitrepos_github.php');

class GITFactory
{
    /**
     * Get Repositories sorted by activation date
     *
     * @param   \Joomla\Registry\Registry $params module parameters
     *
     * @return  GitRepos  GitRepos instance
     *          String on failure
     */
    public static function getGITRepos($params)
    {
        // Load hosting parameter
        $hosting = $params->get('hosting', '');
        // Load user parameter
        $user    = $params->get('username', '');

        $git = null;
        try
        {
            $git_class = 'GitRepos_' . $hosting;
            if (class_exists($git_class))
            {
                $git = new $git_class($user, $params);
            }
            else
            {
                return $hosting . " not supported!";
            }
        } catch (Exception $e)
        {
          return $hosting . " : init error!";
        }

        return $git;
    }
}
