<?php
return CMap::mergeArray
(
    require_once(dirname(__FILE__).'/main.php'),
    array(
                'controllerPath' => realpath(__DIR__ . '/../controllers/backend'),
                'viewPath' => realpath(__DIR__ . '/../views/backend'),
                'defaultController' => 'hsadmin',
                'import' => array(
                        'application.forms.backend.*',
                ),
                'components' => array(
                    'urlManager' => array(
                            'urlFormat' => 'path',
                            'showScriptName' => false,
                            'caseSensitive'=>false,
                            'urlSuffix'=>'/',
                            'rules' => array(
                                    'hsadmin'=>'admin/index',
                                    'hsadmin/action/<_a>'=>'admin/<_a>',
                                    'hsadmin/<_c>'=>'<_c>/index',
                                    'hsadmin/<_c>/<_a>'=>'<_c>/<_a>',
                            ),
                    ),
                    'log'=>array(
                        'class'=>'CLogRouter',
                        'routes'=>array(
                            array(
                            'class'=>'CFileLogRoute',
                            'levels'=>'error, warning',
                            ),
	                    array(
	                        'class'=>'CProfileLogRoute',
	                        'levels'=>'profile',
	                        'enabled'=>true,
	                    ),

			            ),
                    ),

                ),
        )
);
?>
