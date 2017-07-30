<?php

namespace Amit\Affiliate\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface AffRepositoryInterface
{

public function getAffiliates(SearchCriteriaInterface $criteria);
}