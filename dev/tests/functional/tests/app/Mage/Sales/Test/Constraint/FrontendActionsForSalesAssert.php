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

namespace Mage\Sales\Test\Constraint;

use Mage\Customer\Test\Fixture\Customer;
use Mage\Sales\Test\Page\OrderHistory;
use Mage\Sales\Test\Page\OrderView;
use Mage\Customer\Test\Constraint\FrontendActionsForCustomer;

/**
 * Frontend actions for sales asserts.
 */
class FrontendActionsForSalesAssert extends FrontendActionsForCustomer
{
    /**
     * Order history page.
     *
     * @var OrderHistory
     */
    protected $orderHistory;

    /**
     * Order view page.
     *
     * @var OrderView
     */
    protected $customerOrderView;

    /**
     * Pages array.
     *
     * @var array
     */
    protected $pages = [
        'customerAccountIndex' => 'Mage\Customer\Test\Page\CustomerAccountIndex',
        'orderHistory' => 'Mage\Sales\Test\Page\OrderHistory',
        'customerOrderView' => 'Mage\Sales\Test\Page\OrderView'
    ];

    /**
     * @constructor
     */
    public function __construct()
    {
        foreach ($this->pages as $key => $page) {
            $this->$key = $this->createPage($page);
        }
    }

    /**
     * Login customer and open Order page.
     *
     * @param Customer $customer
     * @return void
     */
    public function loginCustomerAndOpenOrderPage(Customer $customer)
    {
        $this->loginCustomer($customer);
        $this->customerAccountIndex->open()->getAccountNavigationBlock()->openNavigationItem('My Orders');
    }

    /**
     * Open entity tab.
     *
     * @param string $orderId
     * @param string $entityType
     * @return void
     */
    public function openEntityTab($orderId, $entityType)
    {
        $this->orderHistory->getOrderHistoryBlock()->openOrderById($orderId);
        $this->customerOrderView->getOrderViewBlock()->openLinkByName(ucfirst($entityType) . 's');
    }
}
