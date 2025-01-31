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

namespace Mage\Admin\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Admin\Test\Page\Adminhtml\UserEdit;

/**
 * Asserts that error message appears after creating admin user with existed username or email.
 */
class AssertUserDuplicateMessage extends AbstractConstraint
{
    /**
     * User already exists error message.
     */
    const ERROR_MESSAGE = 'A user with the same user name or email already exists.';

    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Asserts that error message equals to expected message.
     *
     * @param UserEdit $userEdit
     * @return void
     */
    public function processAssert(UserEdit $userEdit)
    {
        $failedMessage = $userEdit->getMessagesBlock()->getErrorMessages();
        \PHPUnit_Framework_Assert::assertEquals(
            self::ERROR_MESSAGE,
            $failedMessage,
            'Wrong error message is displayed.'
        );
    }

    /**
     * Return string representation of object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Error message on creation user page is correct.';
    }
}
