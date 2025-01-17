<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Machwatt.SfFilecollectionGallery',
    'Pifilecollectiongallery',
    [
        'Gallery' => 'list, nested, nestedFromFolder, listFromFolder',
    ],
    // non-cacheable actions
    [
        'Gallery' => '',

    ]
);

// Use hook from http://www.derhansen.de/2014/06/typo3-how-to-prevent-empty-flexform.html
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['sf_filecollection_gallery'] = 'Machwatt\SfFilecollectionGallery\Hooks\DataHandlerHooks';
