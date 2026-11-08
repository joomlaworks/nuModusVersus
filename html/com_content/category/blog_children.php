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

<?php if (!empty($this->children[$this->category->id]) && $this->maxLevel != 0): ?>
<div class="itemListSubCategories">
<h3><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>  
<?php
    foreach ($this->children[$this->category->id] as $id => $child):
        if ($this->params->get('show_empty_categories') || $child->numitems || !empty($child->getChildren())): ?>

		<?php if (!isset($this->children[$this->category->id][$id + 1])) {
		    $class = ' subCategoryContainerLast';
		} else {
		    $class = '';
		} ?>

		<div class="subCategoryContainer<?php echo $class; ?>">
			<div class="subCategory">
				<h2>
					<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
						<?php echo $this->escape($child->title); ?><?php if ($this->params->get('show_cat_num_articles', 1)) {
						    echo ' ('.$child->getNumItems(true).')';
						} ?>
					</a>
				</h2>

				<?php if ($this->params->get('show_subcat_desc') == 1): ?>
					<?php if ($child->description): ?>
						<div class="subCategoryDesc">
							<?php echo JHtml::_('content.prepare', $child->description); ?>
						</div>
					<?php endif; ?>
	            <?php endif; ?>
			</div>
		</div>

		<?php if (!empty($child->getChildren())):
		    $this->children[$child->id] = $child->getChildren();
		    $this->category = $child;
		    $this->maxLevel--;
		    if ($this->maxLevel != 0):
		        echo $this->loadTemplate('children');
		    endif;
		    $this->category = $child->getParent();
		    $this->maxLevel++;
		endif; ?>

		<?php endif; ?>
	<?php endforeach; ?>
<div class="clr"></div>
</div>	
<?php endif; ?>
