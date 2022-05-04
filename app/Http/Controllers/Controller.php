<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($message, $data = [], $status = true, $code = 200) {
        return response([
            'status' => $status,
            'message' => $message,
            'data' => $data],
            $code);
    }

    public function sendMessage($message, $status = true, $code = 200) {
        return response([
            'status' => $status,
            'message' => $message],
            $code);
    }

    public function sendBadRequest($message) {
        return response([
            'status' => false,
            'message' => $message],
            400
        );
    }

    public function sendPaginator($message, $paginator) {

        $meta = [
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'total' => $paginator->total(),
            'next_page_url' => $paginator->nextPageUrl(),
            'previous_page_url' => $paginator->previousPageUrl(),
            'first_item' => $paginator->firstItem(),
            'last_item' => $paginator->lastItem(),
        ];

        return response([
            'status' => true,
            'message' => $message,
            'data' => $paginator->items(),
            'meta' => $meta]);
    }
}
