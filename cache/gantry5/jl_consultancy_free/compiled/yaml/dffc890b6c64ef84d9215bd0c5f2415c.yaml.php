<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp64\\www\\newlionsdla6/templates/jl_consultancy_free/custom/config/default/layout.yaml',
    'modified' => 1551046191,
    'data' => [
        'version' => 2,
        'preset' => [
            'image' => 'gantry-admin://images/layouts/home.png',
            'name' => 'default',
            'timestamp' => 1546799030
        ],
        'layout' => [
            '/header/' => [
                0 => [
                    0 => 'custom-5173'
                ]
            ],
            '/navigation/' => [
                0 => [
                    0 => 'logo-1829 15',
                    1 => 'menu-5263 85'
                ]
            ],
            '/slideshow/' => [
                0 => [
                    0 => 'position-position-1765'
                ]
            ],
            '/container-main/' => [
                0 => [
                    0 => [
                        'sidebar 14' => [
                            
                        ]
                    ],
                    1 => [
                        'mainbar 72' => [
                            0 => [
                                0 => 'system-messages-4126'
                            ],
                            1 => [
                                0 => 'system-content-1246'
                            ]
                        ]
                    ],
                    2 => [
                        'aside 14' => [
                            
                        ]
                    ]
                ]
            ],
            '/abovefooter/' => [
                0 => [
                    0 => 'custom-3704 30',
                    1 => 'custom-7118 30',
                    2 => 'custom-3615 40'
                ],
                1 => [
                    0 => 'social-9438 50',
                    1 => 'position-position-4980 50'
                ]
            ],
            '/footer/' => [
                0 => [
                    0 => 'branding-4929'
                ]
            ],
            'offcanvas' => [
                0 => [
                    0 => 'mobile-menu-7330'
                ]
            ]
        ],
        'structure' => [
            'header' => [
                'attributes' => [
                    'boxed' => '',
                    'class' => 'section-horizontal-paddings'
                ]
            ],
            'navigation' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '',
                    'class' => 'section-horizontal-paddings'
                ]
            ],
            'slideshow' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '2',
                    'class' => 'section-horizontal-paddings'
                ]
            ],
            'sidebar' => [
                'type' => 'section'
            ],
            'mainbar' => [
                'type' => 'section'
            ],
            'container-main' => [
                'attributes' => [
                    'boxed' => '',
                    'class' => 'section-horizontal-paddings section-vertical-paddings',
                    'extra' => [
                        
                    ]
                ]
            ],
            'abovefooter' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '',
                    'class' => 'section-horizontal-paddings'
                ]
            ],
            'footer' => [
                'attributes' => [
                    'boxed' => '',
                    'class' => 'section-horizontal-paddings'
                ]
            ],
            'offcanvas' => [
                'attributes' => [
                    'position' => 'g-offcanvas-left',
                    'class' => '',
                    'extra' => [
                        
                    ],
                    'swipe' => '1',
                    'css3animation' => '1'
                ]
            ]
        ],
        'content' => [
            'custom-5173' => [
                'title' => 'Header Contact',
                'attributes' => [
                    'html' => '<h3 style="margin:0 0 0 25px; font-weight: bold;">Lions Distrito LA6</h3>'
                ]
            ],
            'logo-1829' => [
                'title' => 'Logo / Image'
            ],
            'menu-5263' => [
                'attributes' => [
                    'mobileTarget' => '1'
                ],
                'block' => [
                    'variations' => 'align-right'
                ]
            ],
            'position-position-1765' => [
                'title' => 'Module Position',
                'attributes' => [
                    'key' => 'slideshow'
                ]
            ],
            'custom-3704' => [
                'title' => 'Lions',
                'attributes' => [
                    'html' => '<div class="abovefooter-ct text-center">
  <img src="gantry-media://main-logo/lions.png" alt="" />
<p>Associação Internacional de Lions Clubes </div>
'
                ]
            ],
            'custom-7118' => [
                'title' => 'Pin',
                'attributes' => [
                    'html' => '<div class="abovefooter-ct text-center">
  <img src="gantry-media://main-logo/pin2018.png" alt="" />
<p>Governadoria do Distrito LA-6</p></div>
'
                ]
            ],
            'custom-3615' => [
                'title' => 'Industry',
                'attributes' => [
                    'html' => '<div class="abovefooter-ct">
<h3 class="abovefooter-title">Industry</h3>
<ul>
<li><a href="#"><i class="fa  fa-angle-right"></i> education</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> business</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> realestate</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> technology</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> banking</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> telicommunication</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> much more</a></li>
</ul>
</div>'
                ]
            ],
            'social-9438' => [
                'attributes' => [
                    'enabled' => 0
                ],
                'block' => [
                    'class' => 'social-ft'
                ]
            ],
            'position-position-4980' => [
                'title' => 'Subscribe',
                'attributes' => [
                    'enabled' => 0,
                    'key' => 'subscribe'
                ]
            ],
            'branding-4929' => [
                'attributes' => [
                    'content' => '&copy; 2019.  	
Todos os direitos reservados.',
                    'css' => [
                        'class' => 'text-center'
                    ]
                ]
            ],
            'mobile-menu-7330' => [
                'title' => 'Mobile Menu'
            ]
        ]
    ]
];
