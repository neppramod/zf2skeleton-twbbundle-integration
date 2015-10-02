	<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 5:26 PM
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Education\Controller\Education' => 'Education\Controller\EducationController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'education' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/education[:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Education\Controller\Education',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'education' => __DIR__ . '/../view',
        ),
    ),
);