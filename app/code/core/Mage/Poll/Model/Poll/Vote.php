<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Mage
 * @package    Mage_Poll
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2020 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Pool vote model
 *
 * @category   Mage
 * @package    Mage_Poll
 * @author     Magento Core Team <core@magentocommerce.com>
 *
 * @method Mage_Poll_Model_Resource_Poll_Vote _getResource()
 * @method Mage_Poll_Model_Resource_Poll_Vote getResource()
 *
 * @method int getPollId()
 * @method $this setPollId(int $value)
 * @method int getPollAnswerId()
 * @method $this setPollAnswerId(int $value)
 * @method int getIpAddress()
 * @method $this setIpAddress(int $value)
 * @method int getCustomerId()
 * @method $this setCustomerId(int $value)
 * @method string getVoteTime()
 * @method $this setVoteTime(string $value)
 */
class Mage_Poll_Model_Poll_Vote extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('poll/poll_vote');
    }

    /**
     * Processing object before save data
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _beforeSave()
    {
        if (!$this->getVoteTime()) {
            $this->setVoteTime(Mage::getSingleton('core/date')->gmtDate());
        }
        return parent::_beforeSave();
    }
}
