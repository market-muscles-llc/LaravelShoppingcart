<?php

namespace Gloudemans\Tests\Shoppingcart\Fixtures;

use Gloudemans\Shoppingcart\Contracts\InstanceIdentifier;

class Identifiable implements InstanceIdentifier
{
    /**
     * @var int|string
     */
    private $identifier;

    /**
     * @var int
     */
    private $discountRate;

	/**
	 * @var null|string
	 */
	private $paymentIntent;

	/**
	 * Identifiable constructor.
	 *
	 * @param string $identifier
	 * @param int $discountRate
	 * @param null|string $paymentIntent
	 */
    public function __construct($identifier = 'identifier', $discountRate = 0, $paymentIntent = null)
    {
        $this->identifier = $identifier;
        $this->discountRate = $discountRate;
		$this->paymentIntent = $paymentIntent;
    }

    /**
     * Get the unique identifier to load the Cart from.
     *
     * @return int|string
     */
    public function getInstanceIdentifier($options = null)
    {
        return $this->identifier;
    }

    /**
     * Get the global discount of the current cart instance.
     *
     * @return int
     */
    public function getInstanceGlobalDiscount($options = null)
    {
        return $this->discountRate;
    }

	/**
	 * Get the payment intent of the current cart instance.
	 *
	 * @return string|null
	 */
	public function getInstancePaymentIntent($options = null)
	{
		return $this->paymentIntent;
	}
}
