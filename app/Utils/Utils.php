<?php

namespace App\Utils;

use App\DataObject\ArticlePaginationRequest;
use Illuminate\Http\Request;

class Utils
{
    public function getPagination(Request $request): ArticlePaginationRequest {
        $page = $request->query('page');
        $size = $request->query('size');
        $sortOrder = $request->query('sortOrder');
        $orderBy = $request->query('sortBy');

        $pageSize = (!is_null($size)) ? (int)$size : 10;
        $offset = ($page - 1) * $pageSize;

        $objReq = new ArticlePaginationRequest();
        $objReq->page = (!is_null($page)) ? (int)$page : 1;
        $objReq->size = $pageSize;
        $objReq->offset = $offset;
        $objReq->sortOrder = (!is_null($sortOrder)) ? $sortOrder : 'desc';
        $objReq->sortBy = (!is_null($orderBy)) ? $orderBy : 'id';
        return $objReq;
    }

    public function isPassSqlInjection($input) : bool {
        // Define an array of SQL injection patterns to search for
        $patterns = [
            '/\b(SELECT|UNION|INSERT|UPDATE|DELETE|DROP|CREATE|ALTER)\b/i',
            '/\b(OR|AND|WHERE|FROM|ORDER BY|GROUP BY|JOIN|HAVING)\b/i',
            '/\b(0x[0-9A-Fa-f]+)/',
        ];

        // Loop through patterns and check if any match the input
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return false; // SQL injection pattern detected
            }
        }
        return true; // No SQL injection pattern found
    }
}
