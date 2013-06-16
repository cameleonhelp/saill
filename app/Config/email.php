<?php
/**
 * This is email configuration file.
 *
 * Use it to configure email transports of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *		Mail 		- Send using PHP mail function
 *		Smtp		- Send using SMTP
 *		Debug		- Do not send the email, just return the result
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email. Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {
        public $gmail = array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => 465,
            'username' => 'nepasrepondresaill@gmail.com',
            'password' => 'azerty64',
            'from'=>'nepasrepondresaill@gmail.com',
            'transport' => 'Smtp',
            'charset' => 'utf-8',
            'headerCharset' => 'utf-8'
        );

        public $exchange = array(
            'transport' => 'Smtp',
            'from' => array('email@example.com' => 'Admin SAILL'),
            'host' => 'smtp.ex3.secureserver.net',
            'port' => 587,
            'timeout' => 30,
            'username' => 'verifiedUserName',
            'password' => 'verifiedPassword',
            'client' => null,
            'log' => true,
            'delivery' => 'smtp',
            'tls' => true
        );
        
	public $default = array(
		'transport' => 'Mail',
		'from' => array('administrateur@saill.sncf.fr'=>'Admin SAILL'),
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
	);

	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array('administrateur@saill.sncf.fr' => 'Administrateur SAILL(ne pas repondre)'),
                'username'=>'administrateur@saill.sncf.fr',
                'password'=>'password',
                'host' => 'localhost',
		'port' => 27,
		'timeout' => 30,
		'client' => null,
		'log' => true,
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
	);

	public $fast = array(
		'from' => 'jacques.levavasseur@sncf.fr',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => 'html',
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
	);

}
