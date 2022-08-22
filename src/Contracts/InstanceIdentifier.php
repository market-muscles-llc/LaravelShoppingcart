<?php

namespace Gloudemans\Shoppingcart\Contracts;

interface InstanceIdentifier
{
    /**
     * Get the unique identifier to load the Cart from.
     *
     * @return int|string
     */
    public function getInstanceIdentifier($options = null);

	/**
	 * Get the global discount of the current cart instance.
	 *
	 * @return int
	 */
	public function getInstanceGlobalDiscount($options = null);

	/**
	 * Get the payment intent of the current cart instance.
	 *
	 * @return string|null
	 */
	public function getInstancePaymentIntent($options = null);
}
