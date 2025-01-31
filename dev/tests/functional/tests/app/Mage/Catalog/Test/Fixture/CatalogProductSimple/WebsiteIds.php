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

namespace Mage\Catalog\Test\Fixture\CatalogProductSimple;

use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\Fixture\FixtureInterface;
use Mage\Adminhtml\Test\Fixture\Website;

/**
 * Prepare WebsiteIds for simple product.
 */
class WebsiteIds implements FixtureInterface
{
    /**
     * Prepared dataset data.
     *
     * @var array
     */
    protected $data;

    /**
     * Data set configuration settings.
     *
     * @var array
     */
    protected $params;

    /**
     * Array of Websites fixtures.
     *
     * @var array
     */
    protected $websites;

    /**
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array $data [optional]
     */
    public function __construct(FixtureFactory $fixtureFactory, array $params, array $data = [])
    {
        $this->params = $params;
        if (isset($data['datasets'])) {
            foreach ($data['datasets'] as $dataset) {
                $website = $fixtureFactory->createByCode('website', ['dataset' => $dataset]);
                /** @var Website $website */
                if (!$website->getWebsiteId()) {
                    $website->persist();
                }
                $this->websites[] = $website;
                $this->data[] = $website->getName();
            }
        }
        if (isset($data['websites'])) {
            foreach ($data['websites'] as $website) {
                if ($website instanceof Website && $website->hasData('website_id')) {
                    $this->websites[] = $website;
                    $this->data[] = $website->getName();
                }
            }
        }
    }

    /**
     * Persist attribute options.
     *
     * @return void
     */
    public function persist()
    {
        //
    }

    /**
     * Return prepared data set.
     *
     * @param string|null $key [optional]
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getData($key = null)
    {
        return $this->data;
    }

    /**
     * Return data set configuration settings.
     *
     * @return array
     */
    public function getDataConfig()
    {
        return $this->params;
    }

    /**
     * Return Websites fixtures array.
     *
     * @return array
     */
    public function getWebsites()
    {
        return $this->websites;
    }
}
