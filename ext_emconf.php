<?php

$EM_CONF['sf_filecollection_gallery'] = [
    'title' => 'FileCollection Gallery',
    'description' => 'Simple FileCollection Gallery',
    'category' => 'plugin',
    'author' => 'Jöran Kurschatke',
    'author_email' => 'info@joerankurschatke.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0 - 10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Machwatt\\SfFilecollectionGallery\\' => 'Classes'
        ]
    ]
];
