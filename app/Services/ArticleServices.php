<?php

namespace App\Services;

use App\DataObject\PaginationObject;
use App\DataObject\PaginationRequest;
use App\Repositories\ArticleRepositories;

class ArticleServices implements ArticleServiceInterface
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ArticleRepositories();
    }

    public function getListPaginationArticle(PaginationRequest $filter, string $search): PaginationObject
    {
        return $this->repository->getAllArticle($filter, $search);
    }

}
