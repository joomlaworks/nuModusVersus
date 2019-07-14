<?php
/**
 * @version    1.1.0
 * @package    nuModusVersus (Akhtarma)
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2019 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldNuHeader extends JFormField
{
    public $type = 'NuHeader';

    public function getInput()
    {
        return null;
    }

    public function getLabel()
    {
        $class = (string)$this->element->attributes()->class ? ' '.(string)$this->element->attributes()->class : '';
        $output = '<div class="nuHeaderInner'.$class.'"><h3>'.JText::_((string)$this->element->attributes()->label).'</h3>';
        $description = JText::_((string)$this->element->attributes()->description);
        if ($description) {
            $output .= '<span>'.$description.'</span>';
        }
        $output .= '</div>';
        return $output;
    }
}
