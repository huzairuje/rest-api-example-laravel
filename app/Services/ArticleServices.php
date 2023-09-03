<?php

namespace App\Services;

use App\DataObject\ArticlePaginationObject;
use App\DataObject\ArticlePaginationRequest;
use App\Repositories\ArticleRepositories;

class ArticleServices implements ArticleServiceInterface
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ArticleRepositories();
    }

    public function getListPaginationArticle(ArticlePaginationRequest $filter, string $search): ArticlePaginationObject
    {
        return $this->repository->getAllArticle($filter, $search);
    }

}
