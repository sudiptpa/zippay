<?php

namespace Omnipay\ZipPay;

use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Cart Item.
 *
 * This class defines a single cart item in the Omnipay system.
 *
 * @see ItemInterface
 */
class Item implements ItemInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Create a new item with the specified parameters.
     *
     * @param array|null $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * Initialize this item with the specified parameters.
     *
     * @param array|null $parameters An array of parameters to set on this object
     *
     * @return $this Item
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag();

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this Item
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * Set the item name.
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->getParameter('description');
    }

    /**
     * Set the item description.
     */
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    /**
     * Set the item quantity.
     */
    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getParameter('price');
    }

    /**
     * Set the item price.
     */
    public function setPrice($value)
    {
        return $this->setParameter('price', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getReference()
    {
        return $this->getParameter('reference');
    }

    /**
     * Set the item reference.
     */
    public function setReference($value)
    {
        return $this->setParameter('reference', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getImageUri()
    {
        return $this->getParameter('imageUri');
    }

    /**
     * Set the item imageUri.
     */
    public function setImageUri($value)
    {
        return $this->setParameter('imageUri', $value);
    }
}
