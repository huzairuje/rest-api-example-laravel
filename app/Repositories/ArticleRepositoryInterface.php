<?php

namespace App\Repositories;

use App\DataObject\PaginationRequest;

interface ArticleRepositoryInterface
{
    public function getAllArticle(PaginationRequest $filter, string $search);
}
