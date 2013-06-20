<?php
session_start();
require('core.php');
require('classes/db.class.php');
require('classes/security.class.php');
require('classes/accounts.class.php');
require('classes/grabinfo.class.php');
require('globals.php');




echo infograb::jobs4();
echo '<br>&copy;Jonathon Maguire 2013 - 2014, Jobslog is a name for this project.';




?>