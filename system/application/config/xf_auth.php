<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Config for the xF_auth (xenForo) libary for CodeIgniter 
 *
 *
 * PHP version 5.2 (as needed by xF)
 *
 *
 * @author     Jeremy Hutchings <jerry@metalcat.net>
 * @copyright  GPL
 * @license    http://codeigniter.com/user_guide/license.html
 * @version    $Id$
 * @since      File available since Release 1.0.0
 */
 
/**
 * Config options for xf_auth
 */

$config['xf_auth'] = array();

/**
 * Use for link construction
 */
$config['xf_auth']['forum_url'] = 'http://your.domain.com/forums/';


/**
 * Root location for xenForo install, to locate Autoloader 
 */
$config['xf_auth']['file_dir'] = '/var/www/xenforo' 