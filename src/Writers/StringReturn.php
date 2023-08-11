<?php

namespace Isti\TripPlanner\Writers;

use Isti\TripPlanner\Contracts\Writer\Writer;

class StringReturn implements Writer
{
    /**
     * @param array $data
     * @return string
     */
    public function write(array $data): string
    {
        return implode('', $data);
    }
}
