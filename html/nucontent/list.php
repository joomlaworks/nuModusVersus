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
$js = ' window.addEvent(\'domready\', function(){ $$(\'dl.fillItUpTabs\').each(function(tabs){ new JTabs(tabs); }); });';
$document = JFactory::getDocument();
$document->addScriptDeclaration($js);
JHtml::_('script', 'system/tabs.js', false, true);
?>

<?php if(isset($item->commentsCounter) && ($item->params->get('pageclass_sfx')!=gridView)): ?>
<!-- NuContent Comments Counter Start -->
<div class="liItemCommentsLink nuContentCommentsCounter"><i class="icon-comments"></i> <?php echo $item->commentsCounter; ?></div>
<!-- NuContent Comments Counter End -->
<?php endif; ?>

<!-- NuContent Tags Start -->
<?php if (version_compare(JVERSION, '3.1', 'ge') && ($item->params->get('show_tags', 1) && count($item->tags->itemTags))): echo ''; else: ?> 
  <?php if(isset($item->nuTags) && count($item->nuTags) && ($item->params->get('pageclass_sfx')!=gridView)): ?>
  <div class="liItemTagsBlock nuContentTagsBlock">
      <span><i class="icon-tags"></i><?php //echo JText::_('NUCONTENT_TAGS'); ?></span>
      <?php foreach ($item->nuTags as $tagCounter=>$tag): ?> 
        <?php if (($tagCounter+1)==count($item->nuTags)): ?>
          <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
        <?php else: ?>
          <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?>, </a>
        <?php endif; ?>  
      <?php endforeach; ?>
  </div>
  <?php endif; ?>
<?php endif; ?>
<!-- NuContent Tags End -->

<!-- NuContent Image Start -->
<?php if(isset($item->image) && $item->image): ?>
<div class="liItemImageBlock catItemImageBlock">
  <span class="liItemImage catItemImage">  
    <a href="<?php echo $item->imageXL; ?>" class="modal" rel="{handler: 'image'}" >
      <img src="<?php echo $item->image; ?>" alt="<?php echo JFilterOutput::cleanText($item->title); ?>" />
    </a>
  </span>
</div>
<?php endif; ?>
<!-- NuContent Image End -->

<!-- NuContent Text Start -->
<?php if ($item->params->get('pageclass_sfx')!=gridView): ?>
  <div class="liItemIntroText nuContentIntroText"><?php echo $item->text; ?></div>
<?php endif; ?>
<!-- NuContent Text End -->

