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
 * @copyright  Copyright (c) 2021 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Mage\Catalog\Test\Block\Product\ProductList;

use Magento\Mtf\Block\Block;

/**
 * Bottom toolbar the product list page.
 */
class BottomToolbar extends Block
{
    /**
     * Selector next active element.
     *
     * @var string
     */
    protected $nextPageSelector = 'li.current + li a';

    /**
     * Go to the next page.
     *
     * @return bool
     */
    public function nextPage()
    {
        $nextPageItem = $this->_rootElement->find($this->nextPageSelector);

        if ($nextPageItem->isVisible()) {
            $nextPageItem->click();
            return true;
        }
        return false;
    }
}
