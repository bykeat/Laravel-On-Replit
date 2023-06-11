<?php

namespace App\Services;

class Paginator
{
    public function getPagingNumber($currentPage, $totalRows)
    {
        $pageLimit = 5;
        $skip = $currentPage * $pageLimit;
        $prevPage = $currentPage - 1 < -1 ? -1 : $currentPage - 1;
        $nextPage = $currentPage + 1;

        if ($nextPage * $pageLimit >= $totalRows) {
            $nextPage = 0;
        }

        return [$prevPage, $nextPage, $skip, $pageLimit];
    }
}
