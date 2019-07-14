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

jimport('joomla.form.formfield');

class JFormFieldNuTextArea extends JFormField
{
    public $type = 'NuTextArea';
    
    public function getClass()
    {
        return $this->element['class'] ? (string)$this->element['class'] : null;
    }

    public function getInput()
    {
        // Initialize some field attributes
        $cols = $this->element['cols'] ? (int)$this->element['cols'] : 20;
        $rows = $this->element['rows'] ? (int)$this->element['rows'] : 8;
        $class = $this->element['class'] ? ' '.(string)$this->element['class'] : '';

        $document = JFactory::getDocument();
        $document->addScript('//cdn.joomlaworks.org/ace/src-min-noconflict/ace.js');
        $document->addScriptDeclaration('
			(function($){
				$(document).ready(function(){
					var editor = ace.edit("editor_'.$this->id.'");
					editor.setTheme("ace/theme/twilight");
					editor.getSession().setMode("ace/mode/php");
					editor.getSession().setUseWrapMode(true);
					editor.resize();
					var t = $(\'textarea[name="'.$this->name.'"]\');
					t.hide();
					var textareaValue = t.val();
					editor.getSession().setValue(textareaValue);
					editor.getSession().on(\'change\', function(){
					  t.val(editor.getSession().getValue());
					});
				});
			})(jQuery);
		');

        return '<div id="editor_'.$this->id.'" class="aceEditorBlock'.$class.'"></div><textarea id="'.$this->id.'" name="'.$this->name.'" cols="'.$cols.'" rows="'.$rows.'">'.$this->value.'</textarea>';
    }
}
