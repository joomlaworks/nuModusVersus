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
<div id="k2ModuleBox<?php echo $module->id; ?>" class="modArchivesBlock k2ArchivesBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
  <ul>
    <?php foreach ($months as $month): ?>
    <li>
      <i class="icon-circle-arrow-right"></i>
      <a href="<?php echo $month->link; ?>">
        <span class="catTitle"><?php echo $month->name.' '.$month->y; ?></span>
        <span class="catCounter"><?php if ($params->get('archiveItemsCounter')) echo '('.$month->numOfItems.')'; ?></span>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
