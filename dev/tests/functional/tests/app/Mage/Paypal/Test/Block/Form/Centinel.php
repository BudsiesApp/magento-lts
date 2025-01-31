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

namespace Mage\Paypal\Test\Block\Form;

use Mage\Payment\Test\Fixture\ValidationPassword;
use Magento\Mtf\Block\Form;
use Magento\Mtf\Client\ElementInterface;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\ObjectManager;

/**
 * 3d Secure verification frame block.
 */
class Centinel extends Form
{
    /**
     * 3D secure iFrame locator.
     *
     * @var string
     */
    protected $centinel = "#centinel_authenticate_iframe";

    /**
     * Centinel submit button selector.
     *
     * @var string
     */
    protected $sentinelSubmit = '[name="UsernamePasswordEntry"]';

    /**
     * Body selector.
     *
     * @var string
     */
    protected $body = 'body';

    /**
     * Submit 3d secure verification code.
     *
     * @return void
     */
    public function submitCode()
    {
        $this->browser->find($this->sentinelSubmit)->click();
        try {
            $this->browser->acceptAlert();
        } catch (\PHPUnit_Extensions_Selenium2TestCase_WebDriverException $e) {
        }
        $this->waitForElementNotVisible($this->centinel);
        $this->browser->switchToFrame();
    }

    /**
     * Fill credit card.
     *
     * @param ValidationPassword $pass
     */
    public function fillPass(ValidationPassword $pass)
    {
        $this->waitForElementVisible($this->centinel);
        $this->browser->switchToFrame(new Locator($this->centinel));
        $element = $this->getRootElement();
        parent::fill($pass, $element);
    }

    /**
     * Get root element.
     *
     * @return ElementInterface
     */
    protected function getRootElement()
    {
        return $this->browser->find($this->body);
    }
}
