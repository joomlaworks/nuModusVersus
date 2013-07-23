<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */
 
defined('_JEXEC') or die ; ?>
<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modUsersBlock nuContentUsersBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<ul>
		<?php foreach($users as $key=>$user): ?>
		<li class="<?php echo ($key%2) ? "odd" : "even"; if(count($users)==$key+1) echo ' lastItem'; ?>">

			<?php if($params->get('userAvatar')): ?>
			<span class="ubUserAvatar">
				<img src="<?php echo $user->avatar; ?>" alt="<?php echo JFilterOutput::cleanText($user->name); ?>" style="width:<?php echo $params->get('userAvatarWidth'); ?>px;height:auto;" />
			</span>
			<?php endif; ?>

			<?php if($params->get('userName')): ?>
			<span class="ubUserName" title="<?php echo JFilterOutput::cleanText($user->name); ?>">
				<?php echo $user->name; ?>
			</span>
			<?php endif; ?>

			
			<?php if($params->get('userEmail')): ?>
			<div class="ubUserAdditionalInfo">
				<span class="ubUserEmail" title="<?php echo JText::_('NUCONTENT_EMAIL'); ?>">
					<?php echo JHTML::_('Email.cloak', $user->email); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if($params->get('userItemCount') && count($user->items)): ?>
			<h3><?php echo JText::_('NUCONTENT_RECENT_ITEMS'); ?></h3>
			<ul class="ubUserItems">
				<?php foreach ($user->items as $item): ?>
				<li>
					<a href="<?php echo $item->link; ?>" title="<?php echo JFilterOutput::cleanText($item->title); ?>">
						<?php echo $item->title; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>

			<div class="clr"></div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
