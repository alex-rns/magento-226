<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Block;

use BelodubrovskyiAn\Lesson11ModuleOop\Model\FileList;
use BelodubrovskyiAn\Lesson11ModuleOop\Model\ConstantsMethods;
use BelodubrovskyiAn\Lesson11ModuleOop\Model\Parameters;

/**
 * Class LessonOopBlock
 * @package BelodubrovskyiAn\Lesson11ModuleOop\Block
 */
class LessonOopBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var FileList
     */
    public $fileListGet;
    /**
     * @var ConstantsMethods
     */
    public $constantsAndMethodsGet;

    public $parametersGet;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ConstantsMethods $constantsAndMethods,
        FileList $fileList,
        Parameters $parameters
    ) {
        parent::__construct($context);
        $this->fileListGet = $fileList;
        $this->constantsAndMethodsGet = $constantsAndMethods;
        $this->parametersGet = $parameters;
    }

    public function getFileListObject(): FileList
    {
        return $this->fileListGet;
    }

    public function getConstantsAndMethods(): ConstantsMethods
    {
        return $this->constantsAndMethodsGet;
    }
    public function getParametersFromDi(): Parameters
    {
        return $this->parametersGet;
    }
}
