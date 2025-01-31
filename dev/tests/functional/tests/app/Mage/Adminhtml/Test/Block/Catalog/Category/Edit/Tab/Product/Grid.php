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

namespace Mage\Adminhtml\Test\Block\Catalog\Category\Edit\Tab\Product;

use Magento\Mtf\Client\Locator;

/**
 * Products' grid of Category Products tab.
 */
class Grid extends \Mage\Adminhtml\Test\Block\Widget\Grid
{
    /**
     * 'Select All' link.
     *
     * @var string
     */
    protected $selectAll = '.headings input.checkbox';

    /**
     * An element locator which allows to select entities in grid.
     *
     * @var string
     */
    protected $selectedItem = '.even .checkbox';

    /**
     * Filters array mapping.
     *
     * @var array
     */
    protected $filters = [
        'sku' => [
            'selector' => '#catalog_category_products_filter_sku'
        ]
    ];

    /**
     * Clear grid.
     *
     * @return void
     */
    public function clear()
    {
        $this->_rootElement->find($this->selectAll, Locator::SELECTOR_CSS, 'checkbox')->setValue('No');
    }

    /**
     * Search for item product and select it.
     *
     * @param array $filter
     * @return void
     * @throws \Exception
     */
    public function searchAndSelect(array $filter)
    {
        $this->search($filter);
        $selectItem = $this->_rootElement->find($this->selectItem, Locator::SELECTOR_CSS, 'checkbox');
        if ($selectItem->isVisible()) {
            $selectItem->setValue('No');
            $selectItem->setValue('Yes');
        } else {
            throw new \Exception('Searched item product was not found.');
        }
    }
}
