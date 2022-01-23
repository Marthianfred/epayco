<?php

namespace App\Http\Services\Types;


class Product
{
    /**
     * @var int
     */
    public $id = 1;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $category;

    /**
     * @var string
     */
    public $subcategory;

    /**
     * @var float
     */
    public $price;

    /**
     * Product constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $category
     * @param string $subcategory
     * @param float $price
     */
    public function __construct(int $id, string $name = '', string $category = '', string $subcategory = '', float $price = 0.00)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->price = $price;
    }

}
