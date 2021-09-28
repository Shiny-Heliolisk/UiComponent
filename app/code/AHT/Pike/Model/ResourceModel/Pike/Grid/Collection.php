<?php
namespace AHT\Pike\Model\ResourceModel\Pike\Grid;

use AHT\Pike\Model\Pike;
use Magento\Framework\Api;
use Magento\Framework\Event\ManagerInterface as EventManager;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_pike_pike_grid_collection';
    protected $_eventObject = 'pike_grid_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Pike\Model\Pike\Grid', 'AHT\Pike\Model\ResourceModel\Pike\Grid');
    }
}
