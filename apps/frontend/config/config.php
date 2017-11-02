<?php


require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
// include project configuration
#include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// symfony bootstraping
#require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
#sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);
