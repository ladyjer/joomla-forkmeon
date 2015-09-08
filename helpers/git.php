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

class Git
{
    /**
     * Function to fetch data from Rest Server
     *
     * @param   string $req The URL of the feed to load
     *
     * @return  array  The decoded JSON query
     *
     */
    protected function getJSON($req)
    {
        // Create a new CURL resource
        $ch = curl_init($req);
        // Set options
        curl_setopt($ch, CURLOPT_HEADER, false);

        // API version 3
        $t_vers = curl_version();
        curl_setopt($ch, CURLOPT_USERAGENT, 'curl/' . $t_vers['version']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Grab URL
        $json = curl_exec($ch);

        // Close CURL resource
        curl_close($ch);

        // Decode the fetched JSON
        $obj = json_decode($json, true);

        return $obj;
    }

}