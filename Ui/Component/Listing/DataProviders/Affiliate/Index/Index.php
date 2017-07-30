<?php
namespace Amit\Affiliate\Ui\Component\Listing\DataProviders\Affiliate\Index;

class Index extends \Magento\Ui\DataProvider\AbstractDataProvider
{    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Amit\Affiliate\Model\ResourceModel\Affiliate\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
