<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Model;

/**
 * Class Parameters
 * @package BelodubrovskyiAn\Lesson11ModuleOop\Model
 */
class Parameters
{
    /**
     * @var
     */
    public $stringParam;
    public $instanceParam;
    public $boolParam;
    public $intParam;
    public $globalInitParam;
    public $constantParam;
    public $optionalParam;
    public $arrayParam;
    /**
     * Parameters constructor.
     * @param $stringParam
     * @param $instanceParam
     * @param $boolParam
     * @param $intParam
     * @param $globalInitParam
     * @param $constantParam
     * @param $optionalParam
     * @param $arrayParam
     */
    public function __construct(
        $stringParam,
        $instanceParam,
        $boolParam,
        $intParam,
        $globalInitParam,
        $constantParam,
        $optionalParam,
        $arrayParam
    ) {
        $this->stringParam = $stringParam;
        $this->instanceParam = $instanceParam;
        $this->boolParam = $boolParam;
        $this->intParam = $intParam;
        $this->globalInitParam = $globalInitParam;
        $this->constantParam = $constantParam;
        $this->optionalParam = $optionalParam;
        $this->arrayParam = $arrayParam;
    }

    /**
     * @return array
     */
    public function getParameters() : array
    {
        $param = [];
        $param['stringParam'] = $this->stringParam;
        $param['instanceParam'] = $this->instanceParam;
        $param['boolParam'] = $this->boolParam;
        $param['intParam'] = $this->intParam;
        $param['globalInitParam'] = $this->globalInitParam;
        $param['constantParam'] = $this->constantParam;
        $param['optionalParam'] = $this->optionalParam;
        $param['arrayParam'] = $this->arrayParam;
        return $param;
    }
}
