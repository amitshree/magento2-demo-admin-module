<?php
namespace Amit\Affiliate\Model\ResourceModel\Affiliate;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'affiliate_id';

    protected function _construct()
    {
        $this->_init('Amit\Affiliate\Model\Affiliate','Amit\Affiliate\Model\ResourceModel\Affiliate');
    }
}
