<?php

namespace App\Repositories;

use App\DataObject\ArticlePaginationObject;
use App\DataObject\ArticlePaginationRequest;
use App\Models\Article;

class ArticleRepositories implements ArticleRepositoryInterface
{
    public function getAllArticle(ArticlePaginationRequest $filter, string $search): ArticlePaginationObject {
        // Start with a base query to get all articles
        $query = Article::query();

        // Apply filters if they are set in the $filter object
        if (!is_null($filter->page) && !is_null($filter->offset)) {
            // Assuming you want to paginate the results
            $query->skip($filter->offset);
            $query->take($filter->size);
        }

        if (!is_null($filter->sortOrder) && !is_null($filter->sortBy)) {
            $query->orderBy($filter->sortBy, $filter->sortOrder);
        }

        if (!empty($search)) {
            $query->where('author', 'like','%'.$search.'%')
                ->orWhere('title', 'like','%'.$search.'%')
                ->orWhere('body', 'like','%'.$search.'%');
        }

        //get query when deleted_at is null only
        $query->whereNull('deleted_at');

        //paginate based on the paginate object
        $query->paginate($filter->size);

        $respObj = new ArticlePaginationObject();
        $respObj->listData = $query->get();
        $respObj->countData = $query->count();

        return $respObj;
    }

}
