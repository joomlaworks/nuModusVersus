<?php
/**
 * @version    1.1.0
 * @package    nuModusVersus
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2019 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams ('com_media');

// check if the user vCard or the user profile is enabled and then load the appropriate classes
$formLayout = (($this->params->get('address_check') > 0) && ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) ||
$this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') || 
($this->contact->con_position && $this->params->get('show_position')) || $this->params->get('allow_vcard')  ?'small-9 ':'small-12 ';

?>
<div class="contact<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading')) : ?>
<h1>
  <?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>


  <?php if ($this->contact->name && $this->params->get('show_name')) : ?>
    <h2>
      <span class="contact-name"><?php echo $this->contact->name; ?></span>
    </h2>
  <?php endif;  ?>
  <?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
    <h3>
     <span class="contact-category"><?php echo $this->contact->category_title; ?></span>
    </h3>
  <?php endif; ?>
  <?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
    <?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
    <h3>
      <span class="contact-category"><a href="<?php echo $contactLink; ?>">
        <?php echo $this->escape($this->contact->category_title); ?></a>
      </span>
    </h3>
  <?php endif; ?>
  
  <?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
    <form action="#" method="get" name="selectForm" id="selectForm">
      <?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
      <?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
    </form>
  <?php endif; ?>
  
  <?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
      <?php if ($this->params->get('presentation_style')!='plain'){?>
        <?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc');} ?>
      <?php /* if ($this->params->get('presentation_style')=='plain'):?>
        <?php echo '<h3>'. JText::_('COM_CONTACT_OTHER_INFORMATION').'</h3>'; ?>
      <?php endif; */ ?>
        <div class="contact-miscinfo">
          <div class="<?php echo $this->params->get('marker_class'); ?>">
            <?php echo $this->params->get('marker_misc'); ?>
          </div>           
          <div class="contact-misc">
            <i class="icon-info-sign"></i>
            <?php echo $this->contact->misc; ?>
          </div>
        </div>
    <?php endif; ?> 
    
    
  <?php if ($this->contact->con_position && $this->params->get('show_position') || $this->params->get('allow_vcard') || (($this->params->get('address_check') > 0) && ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) ||
$this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage')): ?>

  <div class="column small-3 omega mobile-4"> 
    <div class="contactDetails lightGrey">
    <?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
      <p class="contact-position"><?php echo $this->contact->con_position; ?></p>
    <?php endif; ?>
  
    <?php echo $this->loadTemplate('address'); ?>
  
    <?php if ($this->params->get('allow_vcard')) :  ?>
      <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
        <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
        <?php echo JText::_('COM_CONTACT_VCARD');?></a>
    <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>       
    
  <div class="column <?php echo $formLayout; // The layout check on the top of the page ?> alpha mobile-4">
    <?php  if ($this->params->get('presentation_style')!='plain'){?>
      <?php  echo  JHtml::_($this->params->get('presentation_style').'.start', 'contact-slider'); ?>
    <?php  echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_DETAILS'), 'basic-details'); } ?>

    <?php if ($this->contact->image && $this->params->get('show_image')) : ?>
      <div class="contact-image">
        <?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
      </div>
    <?php endif; ?>      
    
    <?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
      <?php if ($this->params->get('presentation_style')!='plain'):?>
        <?php  echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form');  ?>
      <?php endif; ?>
      <?php if ($this->params->get('presentation_style')=='plain'):?>
      <?php endif; ?>
      <?php  echo $this->loadTemplate('form');  ?>
    <?php endif; ?>
    <?php if ($this->params->get('show_links')) : ?>
      <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
    
    <?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
      <?php if ($this->params->get('presentation_style')!='plain'):?>
        <?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
        <?php endif; ?>
        <?php if  ($this->params->get('presentation_style')=='plain'):?>
        <?php echo '<h3>'. JText::_('JGLOBAL_ARTICLES').'</h3>'; ?>
        <?php endif; ?>
        <?php echo $this->loadTemplate('articles'); ?>
    <?php endif; ?>
    
    <?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
      <?php if ($this->params->get('presentation_style')!='plain'):?>
        <?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
      <?php endif; ?>
      <?php if ($this->params->get('presentation_style')=='plain'):?>
        <?php echo '<h3>'. JText::_('COM_CONTACT_PROFILE').'</h3>'; ?>
      <?php endif; ?>
      <?php echo $this->loadTemplate('profile'); ?>
    <?php endif; ?>
    
    <?php if ($this->params->get('presentation_style')!='plain'){?>
        <?php echo JHtml::_($this->params->get('presentation_style').'.end');} ?>
  </div>
  
 
  <div class="clr"></div>
</div>
