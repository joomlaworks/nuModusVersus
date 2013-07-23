<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

$count = 1; 

// DO NOT CHANGE ANYTHING BELOW THIS LINE
$document 	= JFactory::getDocument();
$numOfPages = floor(count($items)/$count); 

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php
  $document->addScriptDeclaration("
    \$nuSlider(window).load(function(){
      var viewportHeight = (self.innerWidth || (document.documentElement.clientWidth || (document.body.clientWidth || 0)));
      \$nuSlider('#k2ModuleBox".$module->id." li.item').css({'width':viewportHeight});
       \$nuSlider('#k2ModuleBox".$module->id."').nuSlider( {
           orientation: 'horizontal',
           step:".$count.",
           viewport:".$count.",
           transitionTime : 1500,
           interval : 7000
        });
    });   
    
  ");
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="modSlideshowBlock k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

	<?php if($params->get('itemPreText')): ?>
	<p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
	<?php endif; ?>

	<div class="itemsWrapper">
	<?php if(count($items)): ?>
	  <ul class="items">
	    <?php foreach ($items as $key=>$item):	?>
	    <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?> item">
	
	      <!-- Plugins: BeforeDisplay -->
	      <?php echo $item->event->BeforeDisplay; ?>
	
	      <!-- K2 Plugins: K2BeforeDisplay -->
	      <?php echo $item->event->K2BeforeDisplay; ?>
	      
	      <?php if($params->get('itemImage') && isset($item->image)): ?>
        <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
          <img src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>"/>
        </a>
        <?php endif; ?>
        
        <div class="moduleItemBodyWrap">
          <div class="moduleItemBody">
        		<?php if($params->get('itemDateCreated')): ?>
    	      <span class="moduleItemDateCreated"><?php echo JHTML::_('date', $item->created, 'd F Y'); ?></span>
    	      <?php endif; ?>
    	
    	      <?php if($params->get('itemCategory')): ?>
    	      <?php echo JText::_('K2_IN') ; ?> <a class="moduleItemCategory" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
    	      <?php endif; ?>
    	      
    	      <?php if($params->get('itemAuthor')): ?>
    	      <div class="moduleItemAuthor">
    		      <?php echo K2HelperUtilities::writtenBy($item->authorGender); ?>
    		      
    					<?php if(isset($item->authorLink)): ?>
    					<a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
    					<?php else: ?>
    					<?php echo $item->author; ?>
    					<?php endif; ?>
    					
    					<?php if($params->get('userDescription')): ?>
    					<?php echo $item->authorDescription; ?>
    					<?php endif; ?>
    				</div>
    				<?php endif; ?>
    		      
    		    <?php if($params->get('itemTitle')): ?>
    	      <h2 class="slideTitle">
    	      	<a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
    	      </h2>
    	      <?php endif; ?>
    	      
    	      <?php if($params->get('itemAuthorAvatar')): ?>
    	      <a class="k2Avatar moduleItemAuthorAvatar" rel="author" href="<?php echo $item->authorLink; ?>">
    					<img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
    				</a>
    	      <?php endif; ?>
    							      
    	      <?php if($params->get('itemIntroText')): ?>
          	<div class="moduleItemIntrotext">
          	 <?php echo $item->introtext; ?>
          	</div>
          	<?php endif; ?>
    		      		
    	      <!-- Plugins: AfterDisplayTitle -->
    	      <?php echo $item->event->AfterDisplayTitle; ?>
    	
    	      <!-- K2 Plugins: K2AfterDisplayTitle -->
    	      <?php echo $item->event->K2AfterDisplayTitle; ?>
    	
    	      <!-- Plugins: BeforeDisplayContent -->
    	      <?php echo $item->event->BeforeDisplayContent; ?>
    	
    	      <!-- K2 Plugins: K2BeforeDisplayContent -->
    	      <?php echo $item->event->K2BeforeDisplayContent; ?>		           
    
    	      <?php if($params->get('itemExtraFields') && count($item->extra_fields)): ?>
    	      <div class="moduleItemExtraFields">
    		      <b><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></b>
    		      <ul>
    		        <?php foreach ($item->extra_fields as $extraField): ?>
    						<?php if($extraField->value): ?>
    						<li class="type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
    							<span class="moduleItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
    							<span class="moduleItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
    							<div class="clr"></div>
    						</li>
    						<?php endif; ?>
    		        <?php endforeach; ?>
    		      </ul>
    	      </div>
    	      <?php endif; ?>
    	
    	      <div class="clr"></div>
    	
    	      <?php if($params->get('itemVideo')): ?>
    	      <div class="moduleItemVideo">
    	      	<?php echo $item->video ; ?>
    	      	<span class="moduleItemVideoCaption"><?php echo $item->video_caption ; ?></span>
    	      	<span class="moduleItemVideoCredits"><?php echo $item->video_credits ; ?></span>
    	      </div>
    	      <?php endif; ?>
    	
    	      <div class="clr"></div>
    	
    	      <!-- Plugins: AfterDisplayContent -->
    	      <?php echo $item->event->AfterDisplayContent; ?>
    	
    	      <!-- K2 Plugins: K2AfterDisplayContent -->
    	      <?php echo $item->event->K2AfterDisplayContent; ?>
    	
    	
    	      <?php if($params->get('itemTags') && count($item->tags)>0): ?>
            <div class="moduleItemTags">
              <b><i class="icon-tags"></i><?php //echo JText::_('K2_TAGS'); ?></b>
              <?php foreach ($item->tags as $tagCounter=>$tag): ?>
                <?php if(count($item->tags)==($tagCounter+1)): ?>
                  <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
                <?php else: ?>
                  <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?>,</a>
                <?php endif; ?>  
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
    	
    	      <?php if($params->get('itemAttachments') && count($item->attachments)): ?>
    				<div class="moduleAttachments">
    					<?php foreach ($item->attachments as $attachment): ?>
    					<a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?></a>
    					<?php endforeach; ?>
    				</div>
    	      <?php endif; ?>
    	
    				<?php if($params->get('itemCommentsCounter') && $componentParams->get('comments')): ?>		
    					<i class="icon-comments"></i>
    					<?php if(!empty($item->event->K2CommentsCounter)): ?>
    						<!-- K2 Plugins: K2CommentsCounter -->
    						<?php echo $item->event->K2CommentsCounter; ?>
    					<?php else: ?>
    						<?php if($item->numOfComments>0): ?>
    						<a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
    							<?php echo $item->numOfComments; ?> <?php //if($item->numOfComments>1) echo JText::_('K2_COMMENTS'); else echo JText::_('K2_COMMENT'); ?>
    						</a>
    						<?php else: ?>
    						<a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
    							0<?php //echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
    						</a>
    						<?php endif; ?>
    					<?php endif; ?>
    				<?php endif; ?>
    	
    				<?php if($params->get('itemHits')): ?>
    				<span class="moduleItemHits">
    					<?php //echo JText::_('K2_READ'); ?><i class="icon-eye-open"></i> <?php echo $item->hits; ?><?php //echo JText::_('K2_TIMES'); ?>
    				</span>
    				<?php endif; ?>
    	
    				<?php if($params->get('itemReadMore') && $item->fulltext): ?>
    				<a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
    					<span><?php echo JText::_('K2_READ_MORE'); ?></span>
    				</a>
    				<?php endif; ?>
    	
    	      <!-- Plugins: AfterDisplay -->
    	      <?php echo $item->event->AfterDisplay; ?>
    	
    	      <!-- K2 Plugins: K2AfterDisplay -->
    	      <?php echo $item->event->K2AfterDisplay; ?>
  	      </div>
	      </div>
	      
	      <div class="clr"></div>
	    </li>
	    <?php endforeach; ?>
	  </ul>
	  <?php endif; ?>
	</div>

	<div class="nuSliderPagination">
		<ul>
			<li><span class="prev"><a class="previousButton"></a></span></li>
			<?php foreach($items as $key => $item):?>
				<?php if(($key)%$count == 0){ $class='';} else {$class=' class="hidden"';}?>
				<?php if($key == 0){ $buttonClass='navigationButton navigationButtonActive';} else {$buttonClass='navigationButton';}?>
			<li<?php echo $class; ?>><a class="<?php echo $buttonClass;?>"></a></li>
			<?php endforeach; ?>
			<li><span class="next"><a class="nextButton"></a></span></li>
		</ul>
	</div>

	<?php if($params->get('itemCustomLink')): ?>
	<a class="moduleCustomLink" href="<?php echo $params->get('itemCustomLinkURL'); ?>" title="<?php echo K2HelperUtilities::cleanHtml($itemCustomLinkTitle); ?>"><?php echo $itemCustomLinkTitle; ?></a>
	<?php endif; ?>

	<?php if($params->get('feed')): ?>
	<div class="k2FeedIcon">
		<a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID='.$module->id); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

</div>
