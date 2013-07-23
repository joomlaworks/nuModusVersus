<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ; ?>
<?php 
/*
Important note:If you wish to use the live search option, it's important that you maintain the same class names for wrapping elements, e.g. the wrapping div and form.
*/
?>
<a class="searchToggler" href="#"><span><i class="icon-search"></i></span></a>

<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modSearchBlock nuContentSearchBlock transition toggleSearchState<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); if($params->get('searchBoxAjax')) echo ' nuContentLiveSearchBlock'; ?>">
    
    <form action="<?php echo JRoute::_('index.php'); ?>" method="get" autocomplete="off" class="nuContentSearchBlockForm">
        <input type="text" value="<?php echo $params->get('searchBoxText', JText::_('NUCONTENT_SEARCH')); ?>" name="searchword" maxlength="<?php echo $params->get('searchBoxWidth', 20); ?>" size="<?php echo $params->get('searchBoxWidth', 20); ?>" alt="<?php echo $params->get('searchBoxButtonText', JText::_('NUCONTENT_SEARCH')); ?>" class="inputbox" onblur="if(this.value=='') this.value='<?php echo $params->get('searchBoxText', JText::_('NUCONTENT_SEARCH', true)); ?>';" onfocus="if(this.value=='<?php echo $params->get('searchBoxText', JText::_('NUCONTENT_SEARCH', true)); ?>') this.value='';" />
        <?php if($params->get('searchBoxButton')): ?>        
          <?php if($params->get('searchBoxImageButton')): ?>
          <input type="image" value="<?php echo $params->get('searchBoxButtonText', JText::_('NUCONTENT_SEARCH')); ?>" class="button" onclick="this.form.searchword.focus();" src="<?php echo JURI::base(true); ?>/media/nucontent/images/system/search.png" />
          <?php else: ?>
          <input type="submit" value="<?php echo $params->get('searchBoxButtonText', JText::_('NUCONTENT_SEARCH')); ?>" class="button" onclick="this.form.searchword.focus();" />
          <?php endif; ?>        
        <?php endif; ?>
        <?php if($params->get('searchBoxAjax')): ?>
        <input type="hidden" name="option" value="com_nucontent" />
        <input type="hidden" name="view" value="items" />
        <input type="hidden" name="format" value="raw" />
        <input type="hidden" name="layout" value="search_results" />
        <?php else: ?>
        <input type="hidden" name="option" value="com_search" />
        <input type="hidden" name="task" value="search" />
        <?php endif; ?>
    </form>
    
    <?php if($params->get('searchBoxAjax')): ?>
      <div class="nuContentLiveSearchResults"></div>
    <?php endif; ?>
    
</div>
