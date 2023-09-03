<?php

namespace App\Services;

use App\DataObject\ArticlePaginationRequest;

interface ArticleServiceInterface
{
    public function getListPaginationArticle(ArticlePaginationRequest $filter, string $search);
}
