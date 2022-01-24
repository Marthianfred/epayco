<?php


namespace App\Http\Services\Types;


class Billetera
{

    /**
     * @var int|null
     */
    public $id;

    /**
     * @var string
     */
    public $hash;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $status;

    /**
     * Billetera constructor.
     * @param int|null $id
     * @param string $hash
     * @param string $currency
     * @param string $status
     */
    public function __construct(int $id =null, string $hash = "", string $currency ="", string $status = "")
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->currency = $currency;
        $this->status = $status;
    }

}
