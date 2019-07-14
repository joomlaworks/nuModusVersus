<?php
/**
 * @version    1.1.0
 * @package    nuModusVersus
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2019 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die;

?>
<?php foreach ($this->link_items as $this->item): ?>
<!-- Links Article Title -->
<div class="liBlock catItemView<?php echo $this->pageclass_sfx; ?>">
	<h3 class="liItemTitle catItemTitle">
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>">
			<?php echo $item->title; ?>
		</a>
	</h3>
</div>
<?php endforeach; ?>
