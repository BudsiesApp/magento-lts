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

use Mage\Sales\Test\Page\Adminhtml\SalesOrderView;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert that after cancel sales order successful message appears.
 */
class AssertOrderCancelSuccessMessage extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Message displayed after cancel sales order.
     */
    const SUCCESS_CANCEL_MESSAGE = 'The order has been cancelled.';

    /**
     * Assert that after cancel sales order successful message appears.
     *
     * @param SalesOrderView $salesOrderView
     * @return void
     */
    public function processAssert(SalesOrderView $salesOrderView)
    {
        \PHPUnit_Framework_Assert::assertEquals(
            self::SUCCESS_CANCEL_MESSAGE,
            $salesOrderView->getMessagesBlock()->getSuccessMessages()
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Sales order success cancel message is present.';
    }
}
