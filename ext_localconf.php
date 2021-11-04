<?php

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

ExtensionManagementUtility::addPageTSConfig(
    'mod.wizards.newContentElement.wizardItems.common {
     elements {
        kdstotop_kdstotop {
            iconIdentifier = kdstotop-wizard-icon
            title = LLL:EXT:kdstotop/Resources/Private/Language/locallang_db.xlf:kdstotop
            description = LLL:EXT:kdstotop/Resources/Private/Language/locallang_db.xlf:kdstotop.description
            tt_content_defValues {
            CType = kdstotop_kdstotop
            }
        },     
    }
    show := addToList(kdstotop_kdstotop)
}');

$icons = [
    'kdstotop-wizard-icon' => 'Extension.svg',
];

$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);

foreach ($icons as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        BitmapIconProvider::class,
        ['source' => 'EXT:kdstotop/Resources/Public/Icons/' . $path]
    );
}
ExtensionManagementUtility::addPageTSConfig('
      mod.web_layout.tt_content.preview.kdstotop_kdstotop = EXT:kdstotop/Resources/Private/Templates/Preview/KdsToTopPreview.html
');
ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:kdstotop/Configuration/TsConfig/Page/TCEForm.typoscript">'
);