<?php
/**
 * This is core configuration file.
 *
 * Use it to configure core behaviour of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * In this file you set up your database connection details.
 *
 * @package       cake.config
 */
/**
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * datasource => The name of a supported datasource; valid options are as follows:
 *		Database/Mysql 		- MySQL 4 & 5,
 *		Database/Sqlite		- SQLite (PHP5 only),
 *		Database/Postgres	- PostgreSQL 7 and higher,
 *		Database/Sqlserver	- Microsoft SQL Server 2005 and higher
 *
 * You can add custom database datasources (or override existing datasources) by adding the
 * appropriate file to app/Model/Datasource/Database.  Datasources should be named 'MyDatasource.php',
 *
 *
 * persistent => true / false
 * Determines whether or not the database should use a persistent connection
 *
 * host =>
 * the host you connect to the database. To add a socket or port number, use 'port' => #
 *
 * prefix =>
 * Uses the given prefix for all the tables in this database.  This setting can be overridden
 * on a per-table basis with the Model::$tablePrefix property.
 *
 * schema =>
 * For Postgres specifies which schema you would like to use the tables in. Postgres defaults to 'public'.
 *
 * encoding =>
 * For MySQL, Postgres specifies the character encoding to use when connecting to the
 * database. Uses database default not specified.
 *
 * unix_socket =>
 * For MySQL to connect via socket specify the `unix_socket` parameter instead of `host` and `port`
 */
class DATABASE_CONFIG {
 
   /* var $developmenthome = array( 
        'datasource' => 'Database/Mysql',
        'driver' => 'mysql',
        'connect' => 'mysql_connect',
        'persistent' => false,
        'host' => '10.0.0.8',
        'login' => 'root',
        'password' => '',
        'database' => 'saill_200',
        'prefix' => '',        
        'encoding' => 'utf8'
    );
    
    var $production = array(
        'datasource' => 'Database/Mysql',
        'driver' => 'mysql',
        'connect' => 'mysql_connect',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'saill_200',
        'prefix' => '', 
        'encoding' => 'utf8'
    );
 
    var $development = array(
        'datasource' => 'Database/Mysql',
        'driver' => 'mysql',
        'connect' => 'mysql_connect',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'saill_200',
        'prefix' => '', 
        'encoding' => 'utf8'
    );
    
    var $default = array();
 
    function __construct()
    {
        $this->default = (env('SERVER_ADDR') == '10.0.0.8' || !env('SERVER_ADDR')) ? $this->developmenthome : (env('SERVER_ADDR') == '127.0.0.1' || !env('SERVER_ADDR')) ? $this->development : $this->production;
    }
    
    function DATABASE_CONFIG()
    {
        $this->__construct();
    }*/
    
    /** a décommenter pour faire un bake all **/
    public $default = array( 
        'datasource' => 'Database/Mysql',
        'driver' => 'mysql',
        'connect' => 'mysql_connect',
        'persistent' => false,
        'host' => '10.0.0.8', //localhost - 10.0.0.8
        'login' => 'SAILLADM',
        'password' => 'S@ILL@DM',
        'database' => 'saill_200',
        'prefix' => '',        
        'encoding' => 'utf8'
    );
}
