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
?>
<?php if (is_string($gitRepos)) : ?>
    <div><?php echo $gitRepos; ?></div>
<?php else : ?>
    <?php if (!$gitRepos->isEmpty()) : ?>
        <ul class="<?php echo $moduleclass_sfx ?>">
            <?php foreach ($gitRepos as $key => $repo) : ?>
                <li>
                    <a href="<?php echo $repo->html_url; ?>"
                       target="_blank"><?php echo $repo->name; ?></a> - <?php echo $repo->description; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <cite><?php echo JText::_('MOD_FORKMEON_NO_REPOS'); ?></cite>
    <?php endif; ?>
<?php endif; ?>