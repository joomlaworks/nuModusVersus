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
      \$nuSlider('#nuContentModuleBox".$module->id." li.item').css({'width':viewportHeight});
       \$nuSlider('#nuContentModuleBox".$module->id."').nuSlider( {
           orientation: 'horizontal',
           step:".$count.",
           viewport:".$count.",
           transitionTime : 1500,
           interval : 7000
        });
    });   
    
  ");
?>

<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modSlideshowBlock modItemsBlock nuContentItemsBlock">

	<?php if($params->get('itemPreText')): ?>
	<p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
	<?php endif; ?>
	
	<div class="itemsWrapper">
		<?php if(count($items)): ?>
	  <ul class="items">
	    <?php foreach ($items as $key=>$item):	?>
	    <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?> item">
	      
	      <?php if($params->get('itemImage') && $item->image): ?>
        <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('NUCONTENT_CONTINUE_READING'); ?> &quot;<?php echo JFilterOutput::cleanText($item->title); ?>&quot;">
          <img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>" <?php echo ($params->get('itemImageWidth'))? 'width="'.$params->get('itemImageWidth').'"':''; ?>/>
        </a>
        <?php endif; ?>
        
        <div class="moduleItemBodyWrap">
          <div class="moduleItemBody">
		    
        		<?php if($params->get('itemDateCreated')): ?>
        		<span class="moduleItemDateCreated"><?php echo JText::_('NUCONTENT_WRITTEN_ON') ;?> <?php echo JHTML::_('date', $item->created, 'd F Y'); ?></span>
        		<?php endif; ?>
    
    	      <?php if($params->get('itemCategory')): ?>
    	      <?php echo JText::_('NUCONTENT_IN') ;?> <a class="moduleItemCategory" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryTitle; ?></a>
    	      <?php endif; ?>
    
    	      <?php if($params->get('itemAuthor')): ?>
    	      <span class="moduleItemAuthor"><?php echo $item->author; ?></span>
    	      <?php endif; ?>
    	      
    			  <?php if($params->get('itemTitle')): ?>
    	      <h2 class="slideTitle">
    	      	<a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
    	      </h2>
    	      <?php endif; ?>
    	
    	      <!-- Plugins: AfterDisplayTitle -->
    	      <?php echo $item->event->afterDisplayTitle; ?>
    	
    	      <!-- Plugins: BeforeDisplayContent -->
    	      <?php echo $item->event->beforeDisplayContent; ?>
    
    	      <?php if($params->get('itemAuthorAvatar')): ?>
    	      <span class="nuContentAvatar moduleItemAuthorAvatar">
    					<img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo $item->author; ?>" style="width:<?php echo $params->get('itemAuthorAvatarWidth', 50); ?>px;height:auto;" />
    			  </span>
    	      <?php endif; ?>
    
    	      <!-- Plugins: AfterDisplayTitle -->
    	      <?php echo $item->event->afterDisplayTitle; ?>
    	
    	      <!-- Plugins: BeforeDisplayContent -->
    	      <?php echo $item->event->beforeDisplayContent; ?>
    	      
    	
    	      <?php if($params->get('itemIntroText')): ?>
    	      <div class="moduleItemIntrotext">
    	      	<?php echo $item->introtext; ?>
    	      </div>
    	      <?php endif; ?>
    	
    	      <div class="clr"></div>
    	
    	      <!-- Plugins: AfterDisplayContent -->
    	      <?php echo $item->event->afterDisplayContent; ?>
    		      
    	     <?php if($params->get('itemTags') && count($item->nuTags)>0): ?>
            <div class="moduleItemTags">
              <b><i class="icon-tags"></i><?php //echo JText::_('NUCONTENT_TAGS'); ?></b>
              <?php foreach ($item->nuTags as $tagCounter=>$tag): ?>
                <?php if(count($item->nuTags)==($tagCounter+1)): ?>
                  <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
                <?php else: ?>
                  <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?>,</a>
                <?php endif; ?>            
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
      
            <?php if($params->get('itemHits')): ?>
            <span class="moduleItemHits">
             <?php //echo JText::_('NUCONTENT_READ'); ?><i class="icon-eye-open"></i> <?php echo $item->hits; ?><?php //echo JText::_('NUCONTENT_TIMES'); ?>
            </span>
            <?php endif; ?>
    	
    				<?php if($params->get('itemReadMore') && $item->fulltext): ?>
            <a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
              <span><?php echo JText::_('NUCONTENT_READ_MORE'); ?></span>
            </a>
            <?php endif; ?>  
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
	<a class="moduleCustomLink" href="<?php echo $params->get('itemCustomLinkURL'); ?>" title="<?php echo JFilterOutput::cleanText($params->get('itemCustomLinkTitle')); ?>">
		<?php echo $params->get('itemCustomLinkTitle'); ?>
	</a>
	<?php endif; ?>

</div>