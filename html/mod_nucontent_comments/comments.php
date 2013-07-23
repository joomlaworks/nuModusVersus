<?php
/**
 * @version     1.0.0
 * @package     nuModusVersus
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

defined('_JEXEC') or die ; ?>

<div id="nuContentModuleBox<?php echo $module->id; ?>" class="modCCBlock nuContentLatestCommentsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

    <?php if(count($comments)): ?>
    <ul>
        <?php foreach ($comments as $key=>$comment):    ?>
        <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($comments)==$key+1) echo ' lastItem'; ?>">
            <?php if($comment->userImage): ?>
            <a class="ubUserAvatar lcAvatar" href="<?php echo $comment->userLink; ?>" title="<?php echo $comment->text; ?>">
                <img src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" <?php if($params->get('commentAvatarWidth')) { echo 'style="width:'.$params->get('commentAvatarWidth').'px;height:auto;"';} ?> />
            </a>
            <?php endif; ?>

            <?php if($params->get('commentLink')): ?>
            <a href="<?php echo $comment->link; ?>"><span class="lcComment"><?php echo $comment->text; ?></span></a>
            <?php else: ?>
            <span class="lcComment"><?php echo $comment->text; ?></span>
            <?php endif; ?>
            
            <div class="clr"></div>
            
            <?php if($params->get('commenterName')): ?>
            <span class="lcUsername"><?php echo JText::_('NUCONTENT_WRITTEN_BY'); ?>
                <?php if($comment->userLink): ?>
                <a rel="author" href="<?php echo $comment->userLink; ?>"><?php echo $comment->userName; ?></a>
                <?php else: ?>
                <?php echo $comment->userName; ?>
                <?php endif; ?>
            </span>
            <?php endif; ?>

            <?php if($params->get('commentDate')): ?>
            <span class="lcCommentDate">
                <?php if($params->get('commentDateFormat') == 'relative'): ?>
                <?php echo $comment->commentDate; ?>
                <?php else: ?>
                <?php echo JText::_('NUCONTENT_ON'); ?> <?php echo $comment->commentDate; ?>
                <?php endif; ?>
            </span>
            <?php endif; ?>
            <div class="clr"></div>
        </li>
        <?php endforeach; ?>
        <li class="clearList"></li>
    </ul>
    <?php endif; ?>

</div>
