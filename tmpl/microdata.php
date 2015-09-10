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

$document = JFactory::getDocument();
$document->addStyleSheet('media' .
    DIRECTORY_SEPARATOR . 'mod_forkmeon' .
    DIRECTORY_SEPARATOR . 'css' .
    DIRECTORY_SEPARATOR . 'git.css');
?>
<div class="mod_forkmeon <?php echo $moduleclass_sfx ?>">
    <?php if (is_string($gitRepos)) : ?>
        <div><?php echo $gitRepos; ?></div>
    <?php else : ?>
        <?php if (!$gitRepos->isEmpty()) : ?>
            <ul>
                <?php foreach ($gitRepos as $key => $repo) : ?>
                    <?php $pl = $repo->programmingLanguage; ?>
                    <?php $rp = $repo->runtimePlatform; ?>
                    <li>
                        <div itemscope itemtype="http://schema.org/SoftwareSourceCode">
                            <a href="<?php echo $repo->html_url; ?>" target="_blank">
                                <span itemprop="name"><?php echo $repo->name; ?></span>
                            </a> - <span itemprop="about"><?php echo $repo->description; ?></span>

                            <div style="display: none">
                                <span itemprop="codeRepository"><?php echo $repo->html_url; ?></span>
                                <?php if ($pl) : ?>
                                    <span itemprop="programmingLanguage"><?php echo $pl; ?></span>
                                <?php endif; ?>
                                <?php if ($rp) : ?>
                                    <span itemprop="runtimePlatform"><?php echo $rp; ?></span>
                                <?php endif; ?>
                                <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                                   <span itemprop="name"><?php echo $repo->owner['login']; ?></span>
                                   <span itemprop="image"><?php echo $repo->owner['avatar_url']; ?></span>
                                   <span itemprop="url"><?php echo $repo->owner['html_url']; ?></span>
                                </span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <cite><?php echo JText::_('MOD_FORKMEON_NO_REPOS'); ?></cite>
        <?php endif; ?>
    <?php endif; ?>
</div>
