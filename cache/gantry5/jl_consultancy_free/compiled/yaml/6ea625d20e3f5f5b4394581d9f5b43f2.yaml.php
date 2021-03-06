<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp64/www/newlionsdla6/templates/jl_consultancy_free/layouts/default.yaml',
    'modified' => 1546799030,
    'data' => [
        'version' => 2,
        'preset' => [
            'image' => 'gantry-admin://images/layouts/home.png'
        ],
        'layout' => [
            '/header/' => [
                0 => [
                    0 => 'custom-5173'
                ]
            ],
            '/navigation/' => [
                0 => [
                    0 => 'logo-7657 27',
                    1 => 'menu-5263 73'
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
                    0 => 'custom-7118 31',
                    1 => 'custom-3704 22',
                    2 => 'custom-3615 22',
                    3 => 'position-position-4980 25'
                ],
                1 => [
                    0 => 'social-9438'
                ]
            ],
            '/footer/' => [
                0 => [
                    0 => 'branding-4929 50',
                    1 => 'custom-8697 50'
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
                    'html' => '<div class="header-contact">
  <a href=""><i class="fa fa-phone"></i> +123-456-789</a>
  <span class="seprator">|</span>
  <a href=""><i class="fa fa-envelope"></i> demo@joomlead.com</a>
</div>
'
                ],
                'block' => [
                    'class' => 'hidden-phone'
                ]
            ],
            'logo-7657' => [
                'attributes' => [
                    'image' => 'gantry-media://Logo/logo.png'
                ]
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
            'position-position-4980' => [
                'title' => 'Subscribe',
                'attributes' => [
                    'key' => 'subscribe'
                ]
            ],
            'social-9438' => [
                'block' => [
                    'class' => 'social-ft'
                ]
            ],
            'custom-8697' => [
                'title' => 'Footer Menu',
                'attributes' => [
                    'html' => '<div class="footer-menu">
<a href="#">FAQ</a> <span class="seprator">|</span> <a href="#">Terms &amp; Condition</a> <span class="seprator">|</span> <a href="#">Privacy Policy</a>
</div>'
                ]
            ],
            'mobile-menu-7330' => [
                'title' => 'Mobile Menu'
            ]
        ]
    ]
];
