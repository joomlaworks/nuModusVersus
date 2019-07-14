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
        <?php echo NU_HEAD_BOTTOM; ?>
    </head>
    <body id="<?php echo NU_BODY_ID; ?>" class="<?php echo NU_BODY_CLASS; ?>">
        <?php echo NU_BODY_TOP; ?>
        <jdoc:include type="message" />
        <jdoc:include type="component" />
        <?php echo NU_BODY_BOTTOM; ?>
    </body>
</html>
