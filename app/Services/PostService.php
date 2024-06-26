<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->all();
    }

    public function getPostById($id)
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data)
    {
        return $this->postRepository->create($data);
    }

    public function updatePost($id, array $data)
    {
        $post = $this->postRepository->find($id);
        if ($post) {
            $this->postRepository->update($post, $data);
        }
        return $post;
    }

    public function deletePost($id)
    {
        $post = $this->postRepository->find($id);
        if ($post) {
            return $this->postRepository->destroy($post);
        }
        return false;
    }
    
    public function getUserPosts($userId)
    {
        return $this->postRepository->getPostsByUserId($userId);
    }
}
