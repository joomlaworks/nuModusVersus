<?php
/**
 * @version    1.1.0
 * @package    nuModusVersus
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2019 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).'/includes/helper.php');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#">
    <head>
        <?php echo NU_HEAD_TOP; ?>
        <jdoc:include type="head" />
        <script type="text/javascript">
            var offlineMessages = {
                siteName: '<?php echo nuText($app->getCfg('sitename')); ?>',
                offlineMsg: '<?php echo (strlen(trim($app->getCfg('offline_message'))<5)) ? nuText('JOFFLINE_MESSAGE') : nuText($app->getCfg('offline_message')); ?>',
                offlineImg: '<?php echo ($app->getCfg('offline_image') ? JURI::root(false).$app->getCfg('offline_image') : NU_CDN.'/templates/images/jw_362x90_24.png'); ?>',
                formAction: '<?php echo JRoute::_('index.php', true); ?>',
                formLabelUsername: '<?php echo nuText('JGLOBAL_USERNAME'); ?>',
                formLabelPassword: '<?php echo nuText('JGLOBAL_PASSWORD'); ?>',
                formInputRemember: '<?php echo nuText('JGLOBAL_REMEMBER_ME'); ?>',
                formSubmit: '<?php echo nuText('JLOGIN'); ?>',
                formReturn: '<?php echo base64_encode(JURI::base()); ?>',
                formToken: '<?php echo JSession::getFormToken(); ?>'
            }
        </script>
        <script type="text/javascript" src="<?php echo NU_CDN; ?>/templates/offline.js"></script>
        <?php echo NU_HEAD_BOTTOM; ?>
    </head>
    <body class="offlineWrapper">
        <?php echo NU_BODY_TOP; ?>
        <jdoc:include type="message" />
        <div id="loadOfflinePage"><?php echo JText::_('TPL_NU_FE_LOADING'); ?></div>
        <?php echo NU_BODY_BOTTOM; ?>
    </body>
</html>
