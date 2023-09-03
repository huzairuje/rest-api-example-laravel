<?php

namespace App\Http\Controllers\ArticleController;

use App\Http\Controllers\Controller;
use App\HttpLib\HttpLibResponse;
use App\Primitive\Constant;
use App\Services\ArticleServices;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    protected $service;
    protected $utils;
    protected $httpLib;
    public function __construct()
    {
        $this->service = new ArticleServices();
        $this->utils = new Utils();
        $this->httpLib = new HttpLibResponse();
    }

    /**
     * @throws Exception
     */
    public function getAllArticleHandler(Request $request): HttpLibResponse {
        try {
            $paginateFilter = $this->utils->getPagination($request);
            $searchFilter = $request->query('search');
            if (is_null($searchFilter)) {
                $searchFilter = '';
            } else {
                $isPassed = $this->utils->isPassSqlInjection($searchFilter);
                if (!$isPassed) {
                    return $this->httpLib::error(Constant::SEARCH_HAS_SUSPICIOUS_VALUE, Response::HTTP_BAD_REQUEST);
                }
            }
            $data = $this->service->getListPaginationArticle($paginateFilter, $searchFilter);
            return $this->httpLib::pagination($data->listData, $data->countData, $paginateFilter, Constant::SUCCESS_GET_ARTICLE);
        } catch (Exception $e) {
            return $this->httpLib::error(Constant::SOMETHING_WENT_WRONG, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
