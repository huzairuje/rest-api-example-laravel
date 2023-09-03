<?php

namespace App\Repositories;

use App\DataObject\ArticlePaginationRequest;

interface ArticleRepositoryInterface
{
    public function getAllArticle(ArticlePaginationRequest $filter, string $search);
}
