<?php

namespace App\Contracts;

interface ProvidesFeedback
{
    /**
     * Provides a public getter for an internal iteration counter
     *
     * @return integer
     */
    public function getIterations();
}
