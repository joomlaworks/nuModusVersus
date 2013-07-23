<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ; ?>
<?php if(count($categories)): ?>
<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modCategoriesListBlock nuContentCategoriesListBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<ul class="level1">
	<?php $level = 1; foreach($categories as $key => $category): ?>

		<li class="category-<?php echo $category->id; ?>">
		<a <?php if($category->isActive) { echo 'class="activeCategory"'; } ?> href="<?php echo $category->link; ?>">
		<span class="catTitle"><?php echo $category->title; ?></span>
		<?php if(isset($category->numOfItems)): ?>
		<span class="catCounter">(<?php echo $category->numOfItems; ?>)</span>
		<?php endif; ?>	
		</a>

		<?php if(isset($categories[$key+1]) && $categories[$key]->level == $categories[$key+1]->level):?>
		</li>
		<?php endif;?>
		
		<?php if(isset($categories[$key+1]) && $categories[$key]->level < $categories[$key+1]->level): $level++;?>
		<ul class="level<?php echo $level; ?>">
		<?php endif; ?>
		
		<?php if(isset($categories[$key+1]) && $categories[$key]->level > $categories[$key+1]->level):?>
		<?php echo str_repeat('</li></ul>', $categories[$key]->level - $categories[$key+1]->level); $level = $level-($categories[$key]->level - $categories[$key+1]->level);?>
		<?php endif; ?>
				
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>