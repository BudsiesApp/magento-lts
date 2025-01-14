<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category    Tests
 * @package     Tests_Functional
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Mage\CatalogRule\Test\Constraint;

use Mage\Catalog\Test\Fixture\CatalogProductSimple;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Catalog\Test\Page\Product\CatalogProductView;
use Magento\Mtf\Client\Browser;

/**
 * Assert that price stored in fixture equals to product price on product page.
 */
class AssertCatalogPriceRuleNotInProductPage extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'high';
    /* end tags */

    /**
     * Assert that price stored in fixture equals to product price on product page.
     *
     * @param CatalogProductSimple $productSimple
     * @param Browser $browser
     * @param CatalogProductView $catalogProductView
     * @return void
     */
    public function processAssert(
        CatalogProductSimple $productSimple,
        Browser $browser,
        CatalogProductView $catalogProductView
    ) {
        $productSimple->persist();

        $browser->open($_ENV['app_frontend_url'] . $productSimple->getUrlKey() . '.html');
        $productPriceFromFixture = $productSimple->getPrice();
        $productPrice = number_format($catalogProductView->getViewBlock()->getPriceBlock()->getPrice(), 2);
        \PHPUnit_Framework_Assert::assertEquals($productPrice, $productPriceFromFixture);
    }

    /**
     * Returns a string representation of successful assertion.
     *
     * @return string
     */
    public function toString()
    {
        return 'Price stored in fixture equals to product price on product page.';
    }
}
