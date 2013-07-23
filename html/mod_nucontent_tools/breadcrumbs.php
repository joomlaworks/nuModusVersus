<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ;?>
<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modBreadcrumbsBlock nuContentBreadcrumbsBlock<?php if ($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
    <span class="bcTitle"><?php echo JText::_('NUCONTENT_YOU_ARE_HERE'); ?></span>
    <?php if($params->get('home', JText::_('NUCONTENT_HOME'))): ?>
    <a href="<?php echo JURI::root(); ?>"><?php echo $params->get('home', JText::_('NUCONTENT_HOME')); ?></a>
    <?php if (count($path)): ?>
    <span class="bcSeparator"><?php echo $params->get('seperator', '&raquo;'); ?></span>
    <?php endif; ?>
    <?php endif; ?>
    <?php if (count($path)): ?>
        <?php foreach ($path as $key => $item): ?>
            <?php if(($key+1) < sizeof($path)): ?>
            <a href="<?php echo $item->link; ?>"><?php echo $item->name; ?></a>
            <span class="bcSeparator"><?php echo $params->get('seperator', '&raquo;'); ?></span>
            <?php else: ?>
            <span><?php echo $item->name; ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
     <?php endif; ?>
</div>
