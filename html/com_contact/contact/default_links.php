<?php
/**
 * @version     1.0.1
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die;

if ('plain' == $this->params->get('presentation_style')) :
	echo '<h3>'.JText::_('COM_CONTACT_LINKS').'</h3>';
else :
    echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_LINKS'), 'display-links');
endif;
?>

<div class="contact-links">
	<ul>
		<?php
		    foreach(range('a', 'e') as $char) :// letters 'a' to 'e'
			    $link = $this->contact->params->get('link'.$char);
			    $label = $this->contact->params->get('link'.$char.'_name');

			    if( ! $link) :
			        continue;
			    endif;

			    // Add 'http://' if not present
			    $link = (0 === strpos($link, 'http')) ? $link : 'http://'.$link;

			    // If no label is present, take the link
			    $label = ($label) ? $label : $link;
			    ?>
			<li>
				<a href="<?php echo $link; ?>">
				    <?php echo $label;  ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
