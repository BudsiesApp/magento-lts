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

namespace Mage\Adminhtml\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Adminhtml\Test\Fixture\Store;
use Mage\Adminhtml\Test\Page\Adminhtml\SystemConfig;

/**
 * Assert that created store view displays in backend configuration.
 */
class AssertStoreBackend extends AbstractConstraint
{
    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that created store view displays in backend configuration.
     *
     * @param Store $store
     * @param SystemConfig $systemConfig
     * @return void
     */
    public function processAssert(Store $store, SystemConfig $systemConfig)
    {
        $systemConfig->open();
        \PHPUnit_Framework_Assert::assertTrue(
            $systemConfig->getStoresSwitcher()->isStoreVisible($store),
            "Store " . $store->getName() . " is not visible in dropdown on config page."
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Store View is available in backend configuration.';
    }
}
