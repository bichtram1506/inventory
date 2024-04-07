<?php
 
namespace App\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;

class UserComposer
{
    /**
     * Tạo một composer mới cho profile.
     */

 
    /**
     * Gắn dữ liệu vào view.
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        // Truyền một mảng thuộc tính vào phương thức count()
        $count = $this->users->count(['id' => '3']); // Thay 'id' và 'value' bằng các giá trị thực tế của bạn
        $view->with('count', $count);
    }
    }