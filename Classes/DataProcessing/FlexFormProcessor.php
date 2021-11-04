<?php
namespace Kdstotop\Kdstotop\DataProcessing;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
class FlexFormProcessor implements DataProcessorInterface
{
    /**
     * Process flexform field data to an array
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }
        // set targetvariable, default "flexform"
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'flexform');
        // set fieldname, default "pi_flexform"
        $fieldName = $cObj->stdWrapValue('fieldName', $processorConfiguration, 'pi_flexform');
        // parse flexform
        $flexformService = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Service\\FlexFormService');
        $processedData[$targetVariableName] = $flexformService->convertFlexFormContentToArray($cObj->data[$fieldName]);
        // if targetvariable is settings, try to merge it with contentObjectConfiguration['settings.']
        if ($targetVariableName == 'settings') {
            if (is_array($contentObjectConfiguration['settings.'])) {
                $convertedConf = GeneralUtility::removeDotsFromTS($contentObjectConfiguration['settings.']);
                foreach ($convertedConf as $key => $value) {
                    if (!isset($processedData[$targetVariableName][$key]) || $processedData[$targetVariableName][$key] == false) {
                        $processedData[$targetVariableName][$key] = $value;
                    }
                }
            }
        }
        return $processedData;
    }
}
?>