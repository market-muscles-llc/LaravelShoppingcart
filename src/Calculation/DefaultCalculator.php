<?php

namespace Gloudemans\Shoppingcart\Calculation;

use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Contracts\Calculator;

class DefaultCalculator implements Calculator
{
    public static function getAttribute(string $attribute, CartItem $cartItem)
    {
        $decimals = config('cart.format.decimals', 2);

        switch ($attribute) {
            case 'discount':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_PERCENTAGE) {
                    return $cartItem->price * ($cartItem->getDiscountRate() / 100);
                }

                return $cartItem->getDiscountRate();
            case 'tax':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return round($cartItem->priceTarget * ($cartItem->taxRate / 100), $decimals);
                }

                return $cartItem->priceTarget * ($cartItem->taxRate / 100);
            case 'priceTax':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return round($cartItem->priceTarget + $cartItem->tax, $decimals);
                }

                return $cartItem->priceTarget + $cartItem->tax;
            case 'discountTotal':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return $cartItem->discount * $cartItem->qty;
                }

                return round($cartItem->discount * $cartItem->qty, $decimals);
            case 'priceTotal':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return round($cartItem->price * $cartItem->qty, $decimals);
                }

                return $cartItem->price * $cartItem->qty;
            case 'subtotal':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return max(round($cartItem->priceTotal - $cartItem->discountTotal, $decimals), 0);
                }

                return max($cartItem->priceTotal - $cartItem->discountTotal, 0);
            case 'priceTarget':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return round(($cartItem->priceTotal - $cartItem->discountTotal) / $cartItem->qty, $decimals);
                }

                return ($cartItem->priceTotal - $cartItem->discountTotal) / $cartItem->qty;
            case 'taxTotal':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return round($cartItem->subtotal * ($cartItem->taxRate / 100), $decimals);
                }

                return $cartItem->subtotal * ($cartItem->taxRate / 100);
            case 'total':
                if ($cartItem->getDiscountType() === CartItem::DISCOUNT_FIXED) {
                    return round($cartItem->subtotal + $cartItem->taxTotal, $decimals);
                }

                return $cartItem->subtotal + $cartItem->taxTotal;
            default:
                return;
        }
    }
}
