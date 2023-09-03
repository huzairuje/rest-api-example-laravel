<?php

namespace App\Services;

use App\DataObject\PaginationRequest;

interface ArticleServiceInterface
{
    public function getListPaginationArticle(PaginationRequest $filter, string $search);
}
