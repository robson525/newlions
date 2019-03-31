<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp64/www/newlionsdla6/templates/jl_consultancy_free/custom/particles/backtotop.yaml',
    'modified' => 1546799030,
    'data' => [
        'name' => 'Back To Top',
        'description' => 'Show a back to top button',
        'type' => 'atom',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable to the particles.',
                    'default' => true
                ],
                'css.class' => [
                    'type' => 'input.text',
                    'label' => 'Class',
                    'description' => 'CSS class name for the particle.'
                ],
                'icon' => [
                    'type' => 'input.icon',
                    'label' => 'Back to top icon',
                    'description' => 'Choose icon back to top.',
                    'default' => 'fa fa-angle-double-up'
                ],
                'copyright' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Developed and maintained by <a href="https://www.joomlead.com/" target="_blank">JoomLead.com</a><br><strong>Version: 1.0.0</strong>'
                ]
            ]
        ]
    ]
];
