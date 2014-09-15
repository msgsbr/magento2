<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Checkout\Test\Constraint;

use Mtf\Constraint\AbstractConstraint;
use Magento\Checkout\Test\Page\CheckoutCart;
use Magento\Checkout\Test\Fixture\Cart;
use Magento\Catalog\Test\Fixture\CatalogProductSimple;

/**
 * Class AssertProductQtyInShoppingCart
 */
class AssertProductQtyInShoppingCart extends AbstractConstraint
{
    /**
     * Constraint severeness
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that quantity in the shopping cart is equals to expected quantity from data set
     *
     * @param CheckoutCart $checkoutCart
     * @param Cart $cart
     * @param CatalogProductSimple $product
     * @return void
     */
    public function processAssert(
        CheckoutCart $checkoutCart,
        Cart $cart,
        CatalogProductSimple $product
    ) {
        $checkoutCart->open();
        $cartProductQty = $checkoutCart->getCartBlock()->getCartItem($product)->getQty();
        \PHPUnit_Framework_Assert::assertEquals(
            $cartProductQty,
            $cart->getQty(),
            'Shopping cart product qty: \'' . $cartProductQty
            . '\' not equals with qty from data set: \'' . $cart->getQty() . '\''
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Quantity in the shopping cart equals to expected quantity from data set.';
    }
}
