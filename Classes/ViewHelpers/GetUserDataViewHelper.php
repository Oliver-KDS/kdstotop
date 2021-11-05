<?php

namespace Kdstotop\Kdstotop\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class GetUserDataViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('uid', 'int', 'The uid from User Object', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    )
    {

        // Get the 'uid' from tt_content Element
        $uid = $arguments['uid'];

        // Get the File-Repository
        $beUserRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Beuser\\Domain\\Repository\\BackendUserRepository');
        $beuser = $beUserRepository->findByUidList([$arguments['uid']]);

        return $beuser;
    }
}
