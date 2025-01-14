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
 * @copyright  Copyright (c) 2020-2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$pollModel = Mage::getModel('poll/poll');

$pollModel  ->setDatePosted(Varien_Date::now())
            ->setPollTitle('What is your favorite color')
            ->setStoreIds([1]);

$answers  = [
                ['Green', 4],
                ['Red', 1],
                ['Black', 0],
                ['Magenta', 2]
];

foreach ($answers as $key => $answer) {
    $answerModel = Mage::getModel('poll/poll_answer');
    $answerModel->setAnswerTitle($answer[0])
                ->setVotesCount($answer[1]);

    $pollModel->addAnswer($answerModel);
}

$pollModel->save();
