<?php

namespace AppBundle\Entity;

/**
 * Price
 */
class Price
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $value;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Price
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * @var \AppBundle\Entity\Product
     */
    private $product;


    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Price
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
