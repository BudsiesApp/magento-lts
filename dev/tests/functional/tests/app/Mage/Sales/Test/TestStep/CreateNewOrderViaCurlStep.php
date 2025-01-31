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

namespace Mage\Sales\Test\TestStep;

use Mage\Sales\Test\Fixture\Order;
use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Create new order via curlstep.
 */
class CreateNewOrderViaCurlStep implements TestStepInterface
{
    /**
     * Fixture factory.
     *
     * @var FixtureFactory
     */
    protected $fixtureFactory;

    /**
     * Order dataset.
     *
     * @var string
     */
    protected $orderdataset;

    /**
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param string $orderdataset
     */
    public function __construct(FixtureFactory $fixtureFactory, $orderdataset)
    {
        $this->fixtureFactory = $fixtureFactory;
        $this->dataset = $orderdataset;
    }

    /**
     * Create new order via curl.
     *
     * @return array
     */
    public function run()
    {
        /** @var Order $order */
        $order = $this->fixtureFactory->createByCode('order', ['dataset' => $this->orderdataset]);
        $order->persist();

        return ['order' => $order];
    }
}
