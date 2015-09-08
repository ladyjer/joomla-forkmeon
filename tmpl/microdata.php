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
?>
<?php if (is_string($gitRepos)) : ?>
    <div><?php echo $gitRepos; ?></div>
<?php else : ?>
    <?php if (!$gitRepos->isEmpty()) : ?>
        <ul class="<?php echo $moduleclass_sfx ?>">
            <?php foreach ($gitRepos as $key => $repo) : ?>
                <?php $pl = $repo->programmingLanguage; ?>
                <?php $rp = $repo->runtimePlatform; ?>
                <li>
                    <a href="<?php echo $repo->html_url; ?>"
                       target="_blank"><?php echo $repo->name; ?></a> - <?php echo $repo->description; ?>
                    <div itemscope itemtype="http://schema.org/SoftwareSourceCode" style="display: none;">
                        <span itemprop="name"><?php echo $repo->name; ?></span>
                        <span itemprop="about"><?php echo $repo->description; ?></span>
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
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <cite><?php echo JText::_('MOD_FORKMEON_NO_REPOS'); ?></cite>
    <?php endif; ?>
<?php endif; ?>
