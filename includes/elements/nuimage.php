<?php

/**
 * @version    2.0
 * @package    nuModusVersus (Akhtarma)
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2026 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldNuImage extends JFormField
{
    public $type = 'NuImage';

    public function getInput()
    {
        $template = $this->form->getValue('template');
        $document = JFactory::getDocument();
        JHtml::_('behavior.modal');
        $document->addScriptDeclaration('
            function jInsertFieldValue(value, id) {
                var elem = document.getElementById(id);
                if (elem && elem.value != value) {
                    elem.value = value;
                    elem.dispatchEvent(new Event("change", { bubbles: true }));
                    jMediaRefreshPreview(id);
                }
            }
            function jMediaRefreshPreview(id) {
                var elem = document.getElementById(id);
                var img = document.getElementById(id + "_preview");
                if (!elem || !img) {
                    return;
                }
                var empty = document.getElementById(id + "_preview_empty");
                var holder = document.getElementById(id + "_preview_img");
                img.src = elem.value ? "'.JURI::root().'" + elem.value : "";
                if (empty) {
                    empty.style.display = elem.value ? "none" : "";
                }
                if (holder) {
                    holder.style.display = elem.value ? "" : "none";
                }
            }
        ');
        $id = uniqid('nuImage');
        $output = '
			<div class="nuImage" id="'.$id.'">
				<a class="nuImagePreviewButton" data-nuimage-id="'.$id.'" href="#" title="'.JText::_('TPL_NU_BE_FIELDS_CLICKTOVIEW').' '.$this->value.'"><i class="icon-eye"></i></a>
				<input name="'.$this->name.'" id="'.$id.'_field" value="'.$this->value.'" readonly="readonly" type="text" />
				<a class="nuImageModalButton" data-nuimage-id="'.$id.'" title="'.JText::_('TPL_NU_BE_FIELDS_SELECT').'">'.JText::_('TPL_NU_BE_FIELDS_SELECT').'</a>
				<a class="nuImageClearButton" data-nuimage-id="'.$id.'" href="#"><i class="icon-remove"></i></a>
			</div>
		';
        return $output;
    }
}
