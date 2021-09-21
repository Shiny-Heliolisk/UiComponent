<?php
namespace AHT\Pike\Model\ResourceModel\Pike;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_pike_pike_collection';
    protected $_eventObject = 'pike_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Pike\Model\Pike', 'AHT\Pike\Model\ResourceModel\Pike');
    }
}
