<?php

namespace App\Http\Services\Types;

class ResponseSoap
{
    /**
     * @var bool
     */
    public $status = false;

    /**
     * @var Error
     */
    public $error;

    /**
     * @var array
     */
    public $result;

    /**
     * ResponseSoap constructor.
     * @param bool $status
     * @param Error $error
     * @param array $result
     */
    public function __construct(bool $status, Error $error, array $result = [])
    {
        $this->status = $status;
        $this->error = $error;
        $this->result = $result;
    }
}
