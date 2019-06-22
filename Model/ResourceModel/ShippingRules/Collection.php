<?php

namespace Excellence\ShippingRules\Model\ResourceModel\ShippingRules;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Excellence\ShippingRules\Model\ShippingRules',
            'Excellence\ShippingRules\Model\ResourceModel\ShippingRules');
    }
}
