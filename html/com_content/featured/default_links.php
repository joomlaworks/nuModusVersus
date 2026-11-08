<?php
/**
 * @version    2.0
 * @package    nuModusVersus
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2026 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die;
?>

<!-- Links Article Title -->
<?php foreach ($this->link_items as &$item): ?>
<div class="liBlock catItemView<?php echo $this->pageclass_sfx; ?>">
	<h3 class="liItemTitle catItemTitle">
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->item->title; ?>
		</a>
	</h3>
</div>
<?php endforeach; ?>
