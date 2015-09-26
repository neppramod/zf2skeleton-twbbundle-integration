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
            'Person\Controller\Person' => 'Person\Controller\PersonController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'person' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/person[:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Person\Controller\Person',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'person' => __DIR__ . '/../view',
        ),
    ),
);