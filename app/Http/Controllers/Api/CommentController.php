<?php

namespace App\Http\Controllers\Api;

use App\BlogApp\Services\Comment\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\ListCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    protected CommentService $service;

    /**
     * @param CommentService $service
     */
    public function __construct(CommentService $service){
        $this->service = $service;
    }

    public function list(ListCommentRequest $request)
    {
        return $this->service->relations(['sender'])->list(filters: ['post_id' => $request->post_id]);
    }
}
