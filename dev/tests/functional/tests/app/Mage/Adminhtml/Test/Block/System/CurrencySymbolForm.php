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

namespace Mage\Adminhtml\Test\Block\System;

use Magento\Mtf\Block\Form;
use Magento\Mtf\Client\Element\SimpleElement as Element;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\FixtureInterface;

/**
 * Currency Symbol form.
 */
class CurrencySymbolForm extends Form
{
    /**
     * Custom Currency locator.
     *
     * @var string
     */
    protected $currencyRow = '//tr[td/label[@for="custom_currency_symbol%s"]]';

    /**
     * Fill the root form.
     *
     * @param FixtureInterface $fixture
     * @param Element|null $element
     * @return $this
     */
    public function fill(FixtureInterface $fixture, Element $element = null)
    {
        $element = $this->_rootElement->find(sprintf($this->currencyRow, $fixture->getCode()), Locator::SELECTOR_XPATH);
        $data = $fixture->getData();
        unset($data['code']);
        $mapping = $this->dataMapping($data);
        $this->_fill($mapping, $element);
        return $this;
    }
}
