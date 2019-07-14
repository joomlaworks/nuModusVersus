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

<?php if($this->error): ?>
<div class="searchintro condensed">
			<?php echo $this->escape($this->error); ?>
</div>
<?php endif; ?>
