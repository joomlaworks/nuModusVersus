<?php
/**
 * @version     1.0.2
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).'/includes/helper.php');

?>
<!DOCTYPE html>
<!--[if lte IE 6]><html class="isIE6" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 7]><html class="isIE7" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 8]><html class="isIE8" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 9]><html class="isIE9" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if gt IE 9]><!--><html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#"><!--<![endif]-->
  <head>
    <?php echo NU_HEAD_TOP; ?>
    <jdoc:include type="head" />
    <?php echo NU_HEAD_BOTTOM; ?>
  </head>
	
	<body id="<?php echo NU_BODY_ID; ?>" class="<?php echo $bodyClass; ?>">   
	  
		<header id="mainHeader">
			<div class="row">		
        <h1 id="logo" class="column large-4 small-12 mobile-2">
          <a class="logoText" href="<?php echo $siteurl; ?>">
            <?php if($this->params->get('siteLogo')): ?>
              <img src="<?php echo $this->params->get('siteLogo'); ?>" alt="<?php echo $this->params->get('siteLogoAltText', $sitename); ?>" />
            <?php else: ?>
              <span><?php echo $this->params->get('siteTextAsLogo', $sitename); ?></span>
            <?php endif; ?>
          </a>
        </h1>
        <div class="column large-8 small-12 mobile-2 menuWrap">  
  				<?php if($this->countModules('nuModusVersus_Search')): ?>
  				  <div class="floatRight searchMod">  
  				    <jdoc:include type="modules" name="nuModusVersus_Search" style="nu" />
  				  </div>
  				<?php endif; ?>
  				<?php if($this->countModules('nuModusVersus_Menu')): ?>
            <div id="menuToggler"><span><i class="icon-reorder"></i><?php //echo JText::_('NU_MENU'); ?></span></div>
            <nav class="floatRight mainNavigation">              
              <jdoc:include type="modules" name="nuModusVersus_Menu" style="nu" />
            </nav>
          <?php endif; ?>
  				<div class="clr"></div>			
				</div>	
			</div>
		</header>
		
		<?php if($this->countModules('nuModusVersus_Slideshow')): ?>
      <div id="slideshow">
        <jdoc:include type="modules" name="nuModusVersus_Slideshow" style="nu" />
      </div>
    <?php endif; ?>
    
    <?php if($this->countModules('nuModusVersus_Below_Slideshow') || ($isFrontpage && $this->params->get('contentHighlights'))): ?>
      <div class="belowSlideshow">
        <div class="row">          
          <jdoc:include type="modules" name="nuModusVersus_Below_Slideshow" style="nu" />         
          <!-- Highlights -->
          <?php $highlights = $this->params->get('contentHighlights'); ?>
          <?php if(isset($highlights->entries)): ?>
          <div class="module columnItems-4">  
            <div class="moduleContent">
              <div class="modItemsBlock k2ItemsBlock columnItems-4">
                  <ul>
                  <?php foreach($highlights->entries as $key=>$highlight): ?>
                  <li class="column large-3 small-6 mobile-4">
                    <div class="moduleItemBody equalHeights">                      
                      <div class="moduleItemIcon">
                        <?php echo $highlight->icon; ?>
                      </div>                    
                      <a class="moduleItemTitle" href="<?php echo $highlight->link; ?>"><?php echo $highlight->title; ?></a>                                       
                      <div class="moduleItemIntrotext"><?php echo $highlight->description; ?></div>
                    </div>
                    <div class="moduleItemReadMore">
                      <a href="<?php echo $highlight->link; ?>"><span><?php echo JText::_('NU_READMORE'); ?></span></a>
                    </div>
                    <div class="clr"></div>                    
                  </li>
                  <?php endforeach; ?>
                  <li class="clearList">&nbsp;</li>
                  </ul>
                </div>
              </div> 
              <div class="clr"></div>
          </div>
          <?php endif; ?>          

        </div>
      </div>
    <?php endif; ?>  
    
		<?php if (!$isFrontpage): ?>
		<div class="pageHeaderWrap">
		  <div class="row pageHeader">
		    <?php if (!empty($pageHeading)): ?>
    		  <h2 class="pageTitle column small-4 mobile-4"><?php echo $pageHeading; ?></h2>
    		<?php endif; ?>
    		<?php if($this->countModules('nuModusVersus_Breadcrumbs')): ?>	
      		<div class="column<?php if (!empty($pageHeading)) echo ' small-8'; else echo ' small-12'; ?> mobile-4">  	  
            <jdoc:include type="modules" name="nuModusVersus_Breadcrumbs" style="nu" />
          </div>
        <?php endif; ?>	
        <div class="clr"></div>	
      </div>
    </div>
    <?php endif; ?>		
    
    <?php if($this->countModules('nuModusVersus_Above_Component')): ?>
    <div class="aboveComponent">
      <div class="row">        
          <jdoc:include type="modules" name="nuModusVersus_Above_Component" style="nu" /> 
        <div class="clr"></div>
      </div>
    </div>  
    <?php endif; ?>   
    
		<section class="contentArea<?php if($this->countModules('nuModusVersus_Component')) echo ' smallPaddingTop'; else echo ' largePaddingTop'; ?>" role="main">
		  <div class="row"> 
		    <jdoc:include type="message" />   
        <div class="column <?php if($this->countModules('nuModusVersus_Right') && !($view=='itemlist' && $pageSuffix=='gridView')) echo 'small-9'; else echo 'small-12'; ?> mobile-4 content">         
          <?php if($this->countModules('nuModusVersus_Component')): ?>
            <jdoc:include type="modules" name="nuModusVersus_Component" style="nu" />
            <div class="clr"></div>
          <?php endif; ?>
          
          <jdoc:include type="component" />   
        </div>
        
        <?php if($this->countModules('nuModusVersus_Right') && !($view=='itemlist' && $pageSuffix=='gridView')): ?>
          <aside class="column small-3 mobile-4 rightBar">
            <jdoc:include type="modules" name="nuModusVersus_Right" style="nu" />
          </aside>
        <?php endif; ?>                
        <div class="clr"></div>
      </div> 
    </section>    
    
    <?php if($this->countModules('nuModusVersus_Below_Component')): ?>		
  		<div class="belowComponent">
  		  <div class="row">    		
            <jdoc:include type="modules" name="nuModusVersus_Below_Component" style="nu" /> 
          <div class="clr"></div>
        </div>
      </div>	  
    <?php endif; ?>  
    
    <?php if($this->countModules('nuModusVersus_Bottom')): ?>
      <div class="bottomArea">
        <div class="row">
          <jdoc:include type="modules" name="nuModusVersus_Bottom" style="nu" />
          <div class="clr"></div>
        </div>
      </div>
    <?php endif; ?>  
    
		<footer>
		  <div id="footerContainer">
  			<div class="footerArea row">  
  			  <div id="copyrightsAndCredits" class="column <?php if($this->countModules('nuModusVersus_Footer')) echo 'small-6'; else echo 'small-12'; ?>">			
    				<div id="copyrights">
    					<small>Copyright &copy; <?php echo (date('Y')=='2013') ? '2013' : '2013 - '.date('Y'); ?>. All rights reserved.</small>						
    				</div>
    				<div id="credits">
    						<small>Designed by <a target="_blank" href="<?php echo $this->params->get('nutpCreditsLink'); ?>" title="<?php echo $this->params->get('nutpCreditsName'); ?>"><?php echo $this->params->get('nutpCreditsName'); ?></a>.
    						  Developed by <a target="_blank" href="http://nuevvo.com" title="Nuevvo">Nuevvo</a>
    						</small>
    				</div>
      		  <div class="clr"></div>  			
      		  </div>
      		  <?php if($this->countModules('nuModusVersus_Footer')): ?>
        		  <div class="column small-6">                
                <jdoc:include type="modules" name="nuModusVersus_Footer" style="nu" />
              </div>   
            <?php endif; ?>  
            <div class="clr"></div>
        </div>
      </div>
		</footer>
				
		<jdoc:include type="modules" name="debug" />
	</body>
</html>