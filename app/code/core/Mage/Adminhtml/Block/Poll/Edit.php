<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Poll edit form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Mage_Adminhtml_Block_Poll_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_controller = 'poll';

        $this->_updateButton('save', 'label', Mage::helper('poll')->__('Save Poll'));
        $this->_updateButton('delete', 'label', Mage::helper('poll')->__('Delete Poll'));

        $this->setValidationUrl($this->getUrl('*/*/validate', ['id' => $this->getRequest()->getParam($this->_objectId)]));
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('poll_data') && Mage::registry('poll_data')->getId()) {
            return Mage::helper('poll')->__("Edit Poll '%s'", $this->escapeHtml(Mage::registry('poll_data')->getPollTitle()));
        }
        return Mage::helper('poll')->__('New Poll');
    }
}
