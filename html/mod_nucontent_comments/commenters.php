<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ;?>

<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modCCBlock nuContentTopCommentersBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<?php if(count($commenters)): ?>
	<ul>
		<?php foreach ($commenters as $key=>$commenter): ?>
		<li class="<?php echo ($key%2) ? "odd" : "even"; if(count($commenters)==$key+1) echo ' lastItem'; ?>">

			<?php if($commenter->userImage): ?>
			<a class="ubUserAvatar tcAvatar" rel="author" href="<?php echo $commenter->link; ?>">
        <img src="<?php echo $commenter->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($commenter->userName); ?>" <?php if($params->get('commentAvatarWidth')) { echo 'style="width:'.$params->get('commenterAvatarWidth').'px;height:auto;"';} ?> />
			</a>
			<?php endif; ?>

			<?php if($params->get('commenterLink')): ?>
			<a class="tcLink" rel="author" href="<?php echo $commenter->link; ?>">
			<?php endif; ?>      
      
			<span class="tcUsername"><?php echo $commenter->userName; ?></span>

			<?php if($params->get('commenterCommentsCounter')): ?>
			<span class="tcCommentsCounter"><i class="icon-comments"></i> <?php echo $commenter->counter; ?></span>
			<?php endif; ?>

			<?php if($params->get('commenterLink')): ?>
			</a>
			<?php endif; ?>

			<div class="clr"></div>
		</li>
		<?php endforeach; ?>
		<li class="clearList"></li>
	</ul>
	<?php endif; ?>
</div>
