<?php

namespace Isti\TripPlanner\Contracts\Writer;

interface Writer
{
    /**
     * @param array $data
     * @return string
     */
    public function write(array $data): mixed;
}
