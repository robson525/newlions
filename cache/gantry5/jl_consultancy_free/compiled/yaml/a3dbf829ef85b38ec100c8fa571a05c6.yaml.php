<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp64\\www\\newlionsdla6/templates/jl_consultancy_free/custom/config/_error/layout.yaml',
    'modified' => 1551046191,
    'data' => [
        'version' => 2,
        'preset' => [
            'image' => 'gantry-admin://images/layouts/default.png',
            'name' => '_error',
            'timestamp' => 1502553408
        ],
        'layout' => [
            'header' => [
                
            ],
            'navigation' => [
                
            ],
            '/container-main/' => [
                0 => [
                    0 => [
                        'sidebar 20' => [
                            
                        ]
                    ],
                    1 => [
                        'mainbar 60' => [
                            0 => [
                                0 => 'system-messages-6091'
                            ],
                            1 => [
                                0 => 'system-content-3910'
                            ],
                            2 => [
                                0 => 'custom-5592'
                            ],
                            3 => [
                                0 => 'custom-2850'
                            ]
                        ]
                    ],
                    2 => [
                        'aside 20' => [
                            
                        ]
                    ]
                ]
            ],
            '/abovefooter/' => [
                0 => [
                    0 => 'custom-7118 40',
                    1 => 'custom-3704 30',
                    2 => 'custom-3615 30'
                ],
                1 => [
                    0 => 'social-9438'
                ]
            ],
            'footer' => [
                
            ],
            'offcanvas' => [
                
            ]
        ],
        'structure' => [
            'header' => [
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'children'
                    ]
                ]
            ],
            'navigation' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'children'
                    ]
                ]
            ],
            'sidebar' => [
                'type' => 'section'
            ],
            'mainbar' => [
                'type' => 'section',
                'attributes' => [
                    'class' => ''
                ],
                'block' => [
                    'variations' => 'center'
                ]
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
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'children'
                    ]
                ]
            ],
            'offcanvas' => [
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'children'
                    ]
                ]
            ]
        ],
        'content' => [
            'custom-5592' => [
                'title' => 'Custom HTML',
                'attributes' => [
                    'html' => 'The page you are looking for does not exist. We’re sorry but we can’t seem to find the page you requested.


'
                ]
            ],
            'custom-2850' => [
                'title' => 'Custom HTML',
                'attributes' => [
                    'html' => ' <a class="button er-bt" href="index.php"><i class="fa fa-arrow-circle-left"></i> Go to Home Page</a>'
                ]
            ],
            'custom-7118' => [
                'title' => 'About Us',
                'attributes' => [
                    'html' => '<div class="abovefooter-ct">
  <img src="gantry-media://logo/logo.png" alt="" />
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  <a href="#" class="link-readmore">Read More About Us <i class="fa  fa-long-arrow-right"></i></a>
</div>
'
                ]
            ],
            'custom-3704' => [
                'title' => 'Navigation',
                'attributes' => [
                    'html' => '<div class="abovefooter-ct">
<h3 class="abovefooter-title">Navigation</h3>
<ul>
<li><a href="#"><i class="fa  fa-angle-right"></i> home</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> About</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> projects</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> industry</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> gallery</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> blog</a></li>
<li><a href="#"><i class="fa  fa-angle-right"></i> contact</a></li>
</ul>
</div>
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
                'block' => [
                    'class' => 'social-ft'
                ]
            ]
        ]
    ]
];
