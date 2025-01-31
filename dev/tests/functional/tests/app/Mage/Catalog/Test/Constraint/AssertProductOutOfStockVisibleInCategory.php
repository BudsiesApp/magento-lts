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

namespace Mage\Catalog\Test\Constraint;

use Magento\Mtf\Fixture\InjectableFixture;
use Mage\Cms\Test\Page\CmsIndex;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Catalog\Test\Fixture\CatalogCategory;
use Mage\Catalog\Test\Page\Category\CatalogCategoryView;

/**
 * Assert that out of stock product is visible in the assigned category.
 */
class AssertProductOutOfStockVisibleInCategory extends AbstractConstraint
{
    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that out of stock product is visible in the assigned category.
     *
     * @param CatalogCategoryView $catalogCategoryView
     * @param CmsIndex $cmsIndex
     * @param InjectableFixture $product
     * @param CatalogCategory|null $category
     * @return void
     */
    public function processAssert(
        CatalogCategoryView $catalogCategoryView,
        CmsIndex $cmsIndex,
        InjectableFixture $product,
        CatalogCategory $category = null
    ) {
        $categoryName = $product->hasData('category_ids') ? $product->getCategoryIds()[0] : $category->getName();
        $cmsIndex->open();
        $cmsIndex->getTopmenu()->selectCategory($categoryName);
        $isProductVisible = $catalogCategoryView->getListProductBlock()->isProductVisible($product);
        while (!$isProductVisible && $catalogCategoryView->getBottomToolbar()->nextPage()) {
            $isProductVisible = $catalogCategoryView->getListProductBlock()->isProductVisible($product);
        }
        \PHPUnit_Framework_Assert::assertTrue(
            $isProductVisible,
            "Product is absent on category page."
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "Out of stock product is visible in the assigned category";
    }
}
