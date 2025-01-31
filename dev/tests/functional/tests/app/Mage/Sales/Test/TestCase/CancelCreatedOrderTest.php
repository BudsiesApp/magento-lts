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

namespace Mage\Sales\Test\TestCase;

use Mage\Sales\Test\Fixture\Order;
use Mage\Sales\Test\Page\Adminhtml\SalesOrderIndex;
use Mage\Sales\Test\Page\Adminhtml\SalesOrderView;
use Magento\Mtf\TestCase\Injectable;

/**
 * Preconditions:
 * 1. Create order.
 *
 * Steps:
 * 1. Login to backend.
 * 2. Navigate to Sales > Orders.
 * 3. Open the created order.
 * 4. Do cancel Order.
 * 5. Perform all assertions.
 *
 * @group Order_Management_(CS)
 * @ZephyrId MPERF-7350
 */
class CancelCreatedOrderTest extends Injectable
{
    /**
     * Orders index page.
     *
     * @var SalesOrderIndex
     */
    protected $orderIndex;

    /**
     * Order view page.
     *
     * @var SalesOrderView
     */
    protected $salesOrderView;

    /**
     * Injection data.
     *
     * @param SalesOrderIndex $orderIndex
     * @param SalesOrderView $salesOrderView
     * @return void
     */
    public function __inject(SalesOrderIndex $orderIndex, SalesOrderView $salesOrderView)
    {
        $this->orderIndex = $orderIndex;
        $this->salesOrderView = $salesOrderView;
    }

    /**
     * Cancel created order.
     *
     * @param Order $order
     * @return array
     */
    public function test(Order $order)
    {
        // Preconditions
        $order->persist();

        // Steps
        $this->orderIndex->open();
        $this->orderIndex->getSalesOrderGrid()->searchAndOpen(['id' => $order->getId()]);
        $this->salesOrderView->getPageActions()->cancel();

        return [
            'customer' => $order->getDataFieldConfig('customer_id')['source']->getCustomer(),
            'orderId' => $order->getId(),
            'product' => $order->getEntityId()['products'][0]
        ];
    }
}
