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

// Check if cURL is loaded; if not, proceed no further
if (!extension_loaded('curl'))
{
    echo JText::_('MOD_GITHUB_ERROR_NOCURL');
    return;
}

// Include the latest functions only once
require_once __DIR__ . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'factory.php';

// Check if caching is enabled
if ($params->get('cache') == 1)
{
    // Set the cache parameters
    $cacheTime = $params->get('cache_time');
    $options = array(
        'defaultgroup' => 'mod_forkmeon');
    $cache		= JCache::getInstance('callback', $options);
    $cache->setLifeTime($cacheTime);
    $cache->setCaching(true);

    // Call the cache; if expired, pull new data
    $gitRepos = $cache->call(array('GITFactory', 'getGITRepos'), $params);
}
else
{
    // Pull new data from GIT server
    $gitRepos	= GITFactory::getGITRepos($params);
    //$github = modGithubHelper::compileData($params);
}


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_forkmeon', $params->get('layout', 'default'));
