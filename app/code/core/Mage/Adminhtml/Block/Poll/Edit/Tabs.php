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
 * @copyright  Copyright (c) 2021-2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin poll left menu
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Mage_Adminhtml_Block_Poll_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('poll_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('poll')->__('Poll Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', [
            'label'     => Mage::helper('poll')->__('Poll Information'),
            'title'     => Mage::helper('poll')->__('Poll Information'),
            'content'   => $this->getLayout()->createBlock('adminhtml/poll_edit_tab_form')->toHtml(),
        ])
        ;

        $this->addTab('answers_section', [
                'label'     => Mage::helper('poll')->__('Poll Answers'),
                'title'     => Mage::helper('poll')->__('Poll Answers'),
                'content'   => $this->getLayout()->createBlock('adminhtml/poll_edit_tab_answers')
                                ->append($this->getLayout()->createBlock('adminhtml/poll_edit_tab_answers_list'))
                                ->toHtml(),
                'active'    => $this->getRequest()->getParam('tab') == 'answers_section',
        ]);
        return parent::_beforeToHtml();
    }
}
