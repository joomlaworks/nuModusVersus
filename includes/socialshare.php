<?php

/**
 * @version    2.0
 * @package    nuModusVersus
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2026 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * "Post on X" share link, used by the K2 item and article layouts in place of the old Twitter widget.
 * It's a plain link to X's web intent: no third-party script and no tracking until the visitor clicks it.
 * X logo: Bootstrap Icons 1.13.2 (https://icons.getbootstrap.com), MIT License.
 */
if (!class_exists('NuSocialShare')) {
    class NuSocialShare
    {
        /** The X logo as inline SVG (inherits the text colour) */
        public static function xLogo()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" class="bi bi-twitter-x" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg>';
        }

        /** Link that opens X's "post" dialog for the current page; $via is an X username, with or without the @ */
        public static function xShareLink($via = '')
        {
            $app = JFactory::getApplication();
            $lang = JFactory::getLanguage();
            $template = $app->getTemplate();
            $lang->load('tpl_'.$template, JPATH_SITE) || $lang->load('tpl_'.$template, JPATH_THEMES.'/'.$template);

            $label = $lang->hasKey('TPL_NU_FE_X_POST') ? JText::_('TPL_NU_FE_X_POST') : 'Post';
            $title = $lang->hasKey('TPL_NU_FE_POST_ON_X') ? JText::_('TPL_NU_FE_POST_ON_X') : 'Post on X';

            $url = 'https://x.com/intent/post?url='.rawurlencode(JUri::getInstance()->toString()).'&text='.rawurlencode(JFactory::getDocument()->getTitle());
            $via = ltrim(trim((string) $via), '@');
            if ($via !== '') {
                $url .= '&via='.rawurlencode($via);
            }

            return '<a class="xShareButton" href="'.htmlspecialchars($url, ENT_QUOTES, 'UTF-8').'" target="_blank" rel="noopener noreferrer" title="'.htmlspecialchars($title, ENT_QUOTES, 'UTF-8').'" aria-label="'.htmlspecialchars($title, ENT_QUOTES, 'UTF-8').'">'
                .self::xLogo().'<span>'.htmlspecialchars($label, ENT_QUOTES, 'UTF-8').'</span></a>';
        }
    }
}
