<?php
 
namespace App\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
 
class ProfileComposer
{
    /**
     * Tạo một composer mới cho profile.
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
 
    /**
     * Gắn dữ liệu vào view.
     */
    public function compose(View $view)
    {
        $view->with('count', $this->users->count());
    }
}