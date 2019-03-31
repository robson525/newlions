<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp64/www/newlionsdla6/templates/jl_consultancy_free/blueprints/styles/base.yaml',
    'modified' => 1546799030,
    'data' => [
        'name' => 'Base Styles',
        'description' => 'Base styles for the Consultancy theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Background',
                    'default' => '#ffffff'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Text Color',
                    'default' => '#222222'
                ],
                'text-active-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Text Active Color',
                    'default' => '#232529'
                ]
            ]
        ]
    ]
];
