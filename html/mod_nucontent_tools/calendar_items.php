<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ; ?>
<?php if(count($items)): ?>
<ul class="nuContentCalendarItems">
    <?php foreach ($items as $key => $item): ?>
    <li><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>