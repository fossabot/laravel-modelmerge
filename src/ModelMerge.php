<?php

namespace Alariva\ModelMerge;

use Alariva\ModelMerge\Strategies\MergeSimple;
use Alariva\ModelMerge\Strategies\ModelMergeStrategy;
use Illuminate\Database\Eloquent\Model;

class ModelMerge
{
    /**
     * First model
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $modelA;

    /**
     * Second model
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $modelB;

    /**
     * Merge strategy implementation.
     * 
     * @var [type]
     */
    protected $strategy;

    public function __construct($strategy = null)
    {
        $this->useStrategy($strategy);
    }

    /**
     * Pick a strategy class for merge operation.
     * 
     * @param  Alariva\ModelMerge\Strategies\ModelMergeStrategy $strategy   Instance of a merger strategy
     * 
     * @return $this
     */
    public function useStrategy(ModelMergeStrategy $strategy = null)
    {
        $this->strategy = $strategy === null ? new MergeSimple() : $strategy;

        return $this;
    }

    /**
     * Set model A
     * 
     * @param Model $model
     *
     * @return  $this
     */
    public function setModelA(Model $model)
    {
        $this->modelA = $model;

        return $this;
    }

    /**
     * Set model B
     * 
     * @param Model $model
     *
     * @return  $this
     */
    public function setModelB(Model $model)
    {
        $this->modelB = $model;

        return $this;
    }

    /**
     * Executes the merge for A and B Models
     * 
     * @return Illuminate\Database\Eloquent\Model The model A with merged attributes from model B
     */
    public function merge()
    {
        return $this->strategy->merge($this->modelA, $this->modelB);
    }
}
