<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/home/lionsdla6/www/templates/jl_consultancy_free/blueprints/styles/accent.yaml',
    'modified' => 1559600940,
    'data' => [
        'name' => 'Accent Colors',
        'description' => 'Accent colors for the Consultancy theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'color-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 1',
                    'default' => '#ea8828'
                ],
                'color-2' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 2',
                    'default' => '#3d53e5'
                ]
            ]
        ]
    ]
];
