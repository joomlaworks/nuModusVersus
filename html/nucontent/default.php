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

<?php if(isset($item->commentsCounter)): ?>
<!-- NuContent Comments Counter Start -->
<div class="itemCommentsLink nuContentCommentsCounter"><i class="icon-comments"></i> <?php echo $item->commentsCounter; ?></div>
<!-- NuContent Comments Counter End -->
<?php endif; ?>

<!-- NuContent Tags Start -->
<?php if (version_compare(JVERSION, '3.1', 'ge') && ($item->params->get('show_tags', 1) && count($item->tags->itemTags))): echo ''; else: ?> 
  <?php if(isset($item->nuTags) && count($item->nuTags)): ?>
  <div class="itemTagsBlock nuContentTagsBlock">
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
<div class="itemImageBlock">
  <span class="itemImage">  
    <a href="<?php echo $item->imageXL; ?>" class="modal" rel="{handler: 'image'}" >
      <img src="<?php echo $item->image; ?>" alt="<?php echo JFilterOutput::cleanText($item->title); ?>" />
    </a>
  </span>
</div>
<?php endif; ?>
<!-- NuContent Image End -->

<!-- NuContent Text Start -->
<div class="itemFullText"><?php echo $item->text; ?></div>
<!-- NuContent Text End -->

<!-- NuContent Latest Items From Same Author Start -->
<?php if(isset($item->authorLatestItems) && count($item->authorLatestItems)): ?>
<div class="small-6 mobile-4 floatLeft itemAuthorLatest">
    <h3><?php echo JText::_('NUCONTENT_LATEST_FROM'); ?> <?php echo $item->author; ?></h3>
    <?php /* if(isset($item->authorAvatar)): ?>
    <img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo $item->author; ?>" />
    <?php endif; */ ?>
    <ul>
      <?php foreach($item->authorLatestItems as $key=>$row): ?>
      <li class="<?php echo ($key%2) ? "odd" : "even"; ?>">
        <i class="icon-circle-arrow-right"></i>
        <a href="<?php echo $row->link ?>"><?php echo $row->title; ?></a>
      </li>
      <?php endforeach; ?>
    </ul>
    <div class="clr"></div>
</div>
<?php endif; ?>
<!-- NuContent Latest Items From Same Author End  -->

<?php if($this->articleId == $item->id): ?>
<!-- NuContent Related Items Start -->
<?php if(isset($item->relatedItems) && count($item->relatedItems)): ?>
<div class="small-6 mobile-4 floatLeft itemRelated">
    <h3><?php echo JText::_("NUCONTENT_RELATED_ITEMS_BY_TAG"); ?></h3>
    <ul>
        <?php foreach($item->relatedItems as $key=>$row): ?>
        <li class="<?php echo ($key%2) ? "odd" : "even"; ?>">    
          <i class="icon-circle-arrow-right"></i>        
          <a class="itemRelTitle" href="<?php echo $row->link ?>"><?php echo $row->title; ?></a>            
         <?php /* <div class="itemRelDate"><?php echo JText::_("NUCONTENT_ON"); ?> <?php echo JHtml::_('date', $row->created, JText::_('DATE_FORMAT_LC2')); ?></div>            
          <div class="itemRelCat"><?php echo JText::_("NUCONTENT_IN"); ?> <a href="<?php echo $row->categoryLink ?>"><?php echo $row->categoryTitle; ?></a></div>            
          <div class="itemRelAuthor"><?php echo JText::_("NUCONTENT_BY"); ?> <?php echo $row->author; ?></div>            
          <img class="itemRelImg" src="<?php echo $row->imageS; ?>" alt="<?php JFilterOutput::cleanText($row->title); ?>" />*/ ?>
        </li>
        <?php endforeach; ?>
        <li class="clr"></li>
    </ul>
    <div class="clr"></div>
</div>
<?php endif; ?>
<!-- NuContent Related Items End  -->
<div class="clr"></div>


<!-- NuContent Comments Start -->
<?php if(isset($item->comments)): ?>
<div class="itemComments nuContentComments"><?php echo $item->comments; ?></div>
<?php endif; ?>
<!-- NuContent Comments Start -->


<?php endif; ?>