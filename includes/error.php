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

/* -------------------- API Calls & Assignments -------------------- */
$app					= JFactory::getApplication();
$document 		= JFactory::getDocument();
$language			= JFactory::getLanguage();

$sitename			= $app->getCfg('sitename');
$sitetemplate	= $app->getTemplate();

$siteurl			= JURI::base();
$siterelpath	= $this->baseurl;
$siteabspath	= JPATH_SITE;
$templatePath = JURI::base(true).'/templates/'.$this->template;



/* -------------------- Requests -------------------- */
$option 			= JRequest::getCmd('option');
$view 				= JRequest::getCmd('view');
$layout 			= JRequest::getCmd('layout');
$page 				= JRequest::getCmd('page');
$task 				= JRequest::getCmd('task');
$id 					= JRequest::getInt('id');
$itemid 			= JRequest::getInt('Itemid');
$tmpl 				= JRequest::getCmd('tmpl');



/* -------------------- Helper Functions -------------------- */
// Convert language strings to a JSON friendly format for the error/offline pages
function nuText($str){
	return str_replace("'","\\'",JText::_($str));
}



/* -------------------- Sub-template Specific -------------------- */
if(!isset($this->error)){
	$this->error = JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}
$uri = JFactory::getURI();
$url = $uri->toString();



/* -------------------- Template Constants -------------------- */
if(!defined('NU_CDN')) 					define('NU_CDN', 'https://cdn.joomlaworks.org');



/* -------------------- Custom Template Logic [CAN EDIT] -------------------- */
// Add template specific rules and logic here


