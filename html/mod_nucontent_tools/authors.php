<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ;?>
<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modAuthorsListBlock nuContentAuthorsListBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
  <ul>
    <?php foreach ($authors as $author): ?>
    <li>
      <?php if ($params->get('authorAvatar')):?>
      <span class="ubUserAvatar abAuthorAvatar">
      	<img src="<?php echo $author->avatar; ?>" alt="<?php echo $author->name; ?>" style="width:<?php echo $params->get('authorAvatarWidth'); ?>px;height:auto;" />
      </span>
      <?php endif; ?>

      <span class="abAuthorName">
      	<?php echo $author->name; ?>
      	<?php if ($params->get('authorItemsCounter')):?>
      	<span>(<?php echo $author->items; ?>)</span>
      	<?php endif; ?>
      </span>

      <?php if ($params->get('authorLatestItem') && $author->latest):?>
      <div class="abAuthorLatestItem">
        <i class="icon-angle-right"></i>
        <a class="abAuthorLatestItem" href="<?php echo $author->latest->link; ?>" title="<?php echo $author->latest->title; ?>">
        	<span><?php echo $author->latest->title; ?></span>
        </a>
      </div>
      <?php endif; ?>
      <div class="clr"></div>
    </li>
    <?php endforeach; ?>
    <li class="clearList"></li>
  </ul>
</div>
