<?php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:kdstotop/Resources/Private/Language/locallang_db.xlf:kdstotop',
        'kdstotop_kdstotop',
        'kdstotop-wizard-icon'
    ),
    'CType',
    'kdstotop'
);

$GLOBALS['TCA']['tt_content']['types']['kdstotop_kdstotop'] = array(
    'showitem' => '
       --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,rowDescription,
       --div--;LLL:EXT:kdstotop/Resources/Private/Language/locallang_db.xlf:kdstotop.iconsettings,-palette,
       --palette--;;imaging,--palette--;--div--,
       --div--;LLL:EXT:kdstotop/Resources/Private/Language/locallang_db.xlf:kdstotop.othersettings,-palette,--palette--;;flex,--palette--;
',
    'columns' => array(
        'image' => array(
            'exclude' => 1,
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                array(
                    'appearance' => array(
                        'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                    ),
                    'foreign_match_fields' => array(
                        'fieldname' => 'image',
                        'tablenames' => 'tt_content',
                        'table_local' => 'sys_file',
                    ),
                )
            ),
        ),
    ),
);

$GLOBALS['TCA']['tt_content']['types']['kdstotop_kdstotop']['columnsOverrides'] = array(
    'image' => array(
        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
            'image',
            array(
                'minitems' => 1,
                'maxitems' => 1,
            ),
            'jpg,jpeg,gif,png,tiff,bmp,svg'
        ),
    ),
);

$GLOBALS['TCA']['tt_content']['palettes']['imaging'] = array(
    'showitem' => 'image;Icon'
);
$GLOBALS['TCA']['tt_content']['palettes']['flex'] = array(
    'showitem' => 'pi_flexform'
);

$GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds'][',kdstotop_kdstotop'] = 'FILE:EXT:kdstotop/Configuration/FlexForms/kdstotop.xml';
