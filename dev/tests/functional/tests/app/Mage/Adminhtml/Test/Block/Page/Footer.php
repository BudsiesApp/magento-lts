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
 * @copyright  Copyright (c) 2020 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Mage\Adminhtml\Test\Block\Page;

use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Locator;

/**
 * Header block.
 */
class Footer extends Block
{
    /**
     * @var string
     */
    protected $versionPath = '//div[@class="footer" and contains(.,"OpenMage ver. ';

    /**
     * @param $currentVersion
     * @return string
     */
    protected function getVersionLocator($currentVersion)
    {
        return $this->versionPath . $currentVersion . '")]';
    }

    /**
     *
     */
    public function findVersion($currentVersion)
    {
       return $this->_rootElement->find($this->getVersionLocator($currentVersion), Locator::SELECTOR_XPATH);
    }
}
