<?php
return [
    '@class' => 'Gantry\\Component\\Config\\CompiledConfig',
    'timestamp' => 1546808391,
    'checksum' => '3357eab383b259bcf0ce6546117ba480',
    'files' => [
        'templates/jl_consultancy_free/custom/config/_error' => [
            'index' => [
                'file' => 'templates/jl_consultancy_free/custom/config/_error/index.yaml',
                'modified' => 1546807949
            ],
            'layout' => [
                'file' => 'templates/jl_consultancy_free/custom/config/_error/layout.yaml',
                'modified' => 1546807949
            ]
        ]
    ],
    'data' => [
        'index' => [
            'name' => '_error',
            'timestamp' => 1546807949,
            'version' => 7,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/default.png',
                'name' => '_error',
                'timestamp' => 1502553408
            ],
            'positions' => [
                
            ],
            'sections' => [
                'header' => 'Header',
                'navigation' => 'Navigation',
                'sidebar' => 'Sidebar',
                'mainbar' => 'Mainbar',
                'abovefooter' => 'Abovefooter',
                'aside' => 'Aside',
                'footer' => 'Footer',
                'offcanvas' => 'Offcanvas'
            ],
            'particles' => [
                'messages' => [
                    'system-messages-6091' => 'System Messages'
                ],
                'content' => [
                    'system-content-3910' => 'Page Content'
                ],
                'custom' => [
                    'custom-5592' => 'Custom HTML',
                    'custom-2850' => 'Custom HTML',
                    'custom-7118' => 'About Us',
                    'custom-3704' => 'Navigation',
                    'custom-3615' => 'Industry',
                    'custom-4147' => 'Header Contact'
                ],
                'social' => [
                    'social-9438' => 'Social'
                ],
                'logo' => [
                    'logo-9490' => 'Logo / Image'
                ],
                'menu' => [
                    'menu-7853' => 'Menu'
                ],
                'branding' => [
                    'branding-9894' => 'Branding'
                ],
                'mobile-menu' => [
                    'mobile-menu-1425' => 'Mobile Menu'
                ]
            ],
            'inherit' => [
                'default' => [
                    'header' => 'header',
                    'navigation' => 'navigation',
                    'footer' => 'footer',
                    'offcanvas' => 'offcanvas',
                    'custom-4147' => 'custom-5173',
                    'logo-9490' => 'logo-1829',
                    'menu-7853' => 'menu-5263',
                    'branding-9894' => 'branding-4929',
                    'mobile-menu-1425' => 'mobile-menu-7330'
                ]
            ]
        ],
        'layout' => [
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
    ]
];
