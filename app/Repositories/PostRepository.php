<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Eloquent\EloquentBaseRepository;

class PostRepository extends EloquentBaseRepository
{
    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    /**
     * Lấy tất cả bài viết của một người dùng.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPostsByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
