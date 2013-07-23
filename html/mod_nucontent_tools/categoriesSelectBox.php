<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ; ?>
<div id="nuContentModuleBox<?php echo $module->id; ?>" class="nuContentCategoriesListBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<select name="category" onchange="window.location=this.value;">
		<option value="<?php echo JURI::root(true); ?>/"><?php echo JText::_('NUCONTENT_SELECT_CATEGORY'); ?></option>	
		<?php foreach($categories as $category): ?>
		<option <?php if($category->isActive) { echo 'selected="selected"'; } ?>value="<?php echo $category->link ?>/"><?php echo str_repeat('-', $category->level).$category->title; ?></option>
		<?php endforeach; ?>
	</select>
</div>
