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

use Mage\Admin\Test\Fixture\User;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Adminhtml\Test\Page\AdminAuthLogin;

/**
 * Verify incorrect credentials message while login to admin.
 */
class AssertUserWrongCredentialsMessage extends AbstractConstraint
{
    /**
     * Credentials error message.
     */
    const INVALID_CREDENTIALS_MESSAGE = 'You did not sign in correctly or your account is temporarily disabled.';

    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Verify incorrect credentials message while login to admin.
     *
     * @param AdminAuthLogin $adminAuth
     * @param User $user
     * @return void
     */
    public function processAssert(AdminAuthLogin $adminAuth, User $user)
    {
        $adminAuth->open();
        $adminAuth->getLoginBlock()->loginToAdminPanel($user->getData());

        \PHPUnit_Framework_Assert::assertEquals(
            static::INVALID_CREDENTIALS_MESSAGE,
            $adminAuth->getMessagesBlock()->getErrorMessages(),
            'Message "' . static::INVALID_CREDENTIALS_MESSAGE . '" is not visible.'
        );
    }

    /**
     * Returns success message if equals to expected message.
     *
     * @return string
     */
    public function toString()
    {
        return 'Invalid credentials message was displayed.';
    }
}
