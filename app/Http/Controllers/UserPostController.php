<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PostService;

class UserPostController extends Controller
{
    protected $postService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\PostService  $postService
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the posts for a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $user = User::findOrFail($userId); // Lấy thông tin user từ user_id
        $posts = $this->postService->getUserPosts($userId);
        return view('page.post.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        $user = User::findOrFail($userId); // Lấy thông tin user từ user_id
        return view('page.post.create', compact('userId', 'user')); // Truyền biến $user vào view
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $this->postService->createPost($request->all() + ['user_id' => $userId]);

        return redirect()->route('users.posts.index', $userId)->with('success', 'Bài viết đã được tạo thành công!');
    }

    /**
     * Show the specified post.
     *
     * @param  int  $userId
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $postId)
    {
        $post = Post::findOrFail($postId);
        return view('page.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $userId
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function edit($userId, $postId)
    {
        $user = User::findOrFail($userId);
        $post = Post::findOrFail($postId);
        return view('page.post.edit', compact('user', 'post'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $postId)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $this->postService->updatePost($postId, $request->all());

        return redirect()->route('users.posts.index', $userId)->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $userId
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $postId)
    {
        $this->postService->deletePost($postId);

        return redirect()->route('users.posts.index', $userId)->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function testsql(){
        $user = DB::table('users')->where('id', 1)->first();
        $email = DB::table('users')->where('id', 1)->value('email');
        $user3 = DB::table('users')->find(3);
        $titles = DB::table('users')->pluck('title');
        DB::table('users')->orderBy('id')->chunk(100, function (Collection $users) {
    foreach ($users as $user) {
        // ...
    }
});
    DB::table('users')->where('active', false)
        ->chunkById(100, function (Collection $users) {
            foreach ($users as $user) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['active' => true]);
            }
        });

        DB::table('users')->orderBy('id')->lazy()->each(function ($user) {
    // Xử lý từng phần ghi dữ liệu...
    });
    $users = DB::table('users')->count();
    
    $price = DB::table('orders')->max('price');
    $price = DB::table('orders')
                ->where('finalized', 1)
                ->avg('price');
    
    $ordersExist = DB::table('orders')->where('finalized', 1)->exists();

    $users = DB::table('users')
            ->select('name', 'email as user_email')
            ->get();

            $users = DB::table('users')->distinct()->get();
            $query = DB::table('users')->select('name');
 
            $users = $query->addSelect('age')->get();

            $users = DB::table('users')
             ->select(DB::raw('count(*) as user_count, status'))
             ->where('status', '<>', 1)
             ->groupBy('status')
             ->get();
             $orders = DB::table('orders')
                ->selectRaw('price * ? as price_with_tax', [1.0825])
                ->get();
                $orders = DB::table('orders')
                ->whereRaw('price > IF(state = "TX", ?, 100)', [200])
                ->get();
                $orders = DB::table('orders')
                ->select('department', DB::raw('SUM(price) as total_sales'))
                ->groupBy('department')
                ->havingRaw('SUM(price) > ?', [2500])
                ->get();
                $orders = DB::table('orders')
                ->orderByRaw('updated_at - created_at DESC')
                ->get();
                $orders = DB::table('orders')
                ->select('city', 'state')
                ->groupByRaw('city, state')
                ->get();
                $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
            $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
 
$users = DB::table('users')
            ->rightJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
            $sizes = DB::table('sizes')
            ->crossJoin('colors')
            ->get();
            DB::table('users')
        ->join('contacts', function (JoinClause $join) {
            $join->on('users.id', '=', 'contacts.user_id')->orOn(/* ... */);
        })
        ->get();
        DB::table('users')
        ->join('contacts', function (JoinClause $join) {
            $join->on('users.id', '=', 'contacts.user_id')
                 ->where('contacts.user_id', '>', 5);
        })
        ->get();

        $latestPosts = DB::table('posts')
                   ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
                   ->where('is_published', true)
                   ->groupBy('user_id');
 
        $users = DB::table('users')
                ->joinSub($latestPosts, 'latest_posts', function (JoinClause $join) {
                    $join->on('users.id', '=', 'latest_posts.user_id');
                })->get();
                $latestPosts = DB::table('posts')
                   ->select('id as post_id', 'title as post_title', 'created_at as post_created_at')
                   ->whereColumn('user_id', 'users.id')
                   ->orderBy('created_at', 'desc')
                   ->limit(3);
 
$users = DB::table('users')
            ->joinLateral($latestPosts, 'latest_posts')
            ->get();
            $first = DB::table('users')
            ->whereNull('first_name');
 
$users = DB::table('users')
            ->whereNull('last_name')
            ->union($first)
            ->get();
            $users = DB::table('users')
                ->where('votes', '=', 100)
                ->where('age', '>', 35)
                ->get();
                $users = DB::table('users')->where('votes', 100)->get();
                $users = DB::table('users')
                ->where('votes', '>=', 100)
                ->get();
 
$users = DB::table('users')
                ->where('votes', '<>', 100)
                ->get();
 
$users = DB::table('users')
                ->where('name', 'like', 'T%')
                ->get();
                $users = DB::table('users')->where([
    ['status', '=', '1'],
    ['subscribed', '<>', '1'],
])->get();
$users = DB::table('users')
                    ->where('votes', '>', 100)
                    ->orWhere('name', 'John')
                    ->get();
            $users = DB::table('users')
            ->where('votes', '>', 100)
            ->orWhere(function (Builder $query) {
                $query->where('name', 'Abigail')
                      ->where('votes', '>', 50);
            })
            ->get();

            $products = DB::table('products')
                ->whereNot(function (Builder $query) {
                    $query->where('clearance', true)
                          ->orWhere('price', '<', 10);
                })
                ->get();
                $users = DB::table('users')
            ->where('active', true)
            ->whereAny([
                'name',
                'email',
                'phone',
            ], 'LIKE', 'Example%')
            ->get();
            $posts = DB::table('posts')
            ->where('published', true)
            ->whereAll([
                'title',
                'content',
            ], 'LIKE', '%Laravel%')
            ->get();
            $users = DB::table('users')
                ->whereJsonContains('options->languages', ['en', 'de'])
                ->get();
                $users = DB::table('users')
           ->whereBetween('votes', [1, 100])
           ->get();
           $users = DB::table('users')
                    ->whereNotBetween('votes', [1, 100])
                    ->get();
                    $patients = DB::table('patients')
                       ->whereBetweenColumns('weight', ['minimum_allowed_weight', 'maximum_allowed_weight'])
                       ->get();
                       $patients = DB::table('patients')
                       ->whereNotBetweenColumns('weight', ['minimum_allowed_weight', 'maximum_allowed_weight'])
                       ->get();
                       $users = DB::table('users')
                    ->whereIn('id', [1, 2, 3])
                    ->get();
                    $users = DB::table('users')
                    ->whereNotIn('id', [1, 2, 3])
                    ->get();
                    $activeUsers = DB::table('users')->select('id')->where('is_active', 1);
 
$users = DB::table('comments')
                    ->whereIn('user_id', $activeUsers)
                    ->get();
                    $users = DB::table('users')
                ->whereNull('updated_at')
                ->get();
                $users = DB::table('users')
                ->whereNotNull('updated_at')
                ->get();
                $users = DB::table('users')
                ->whereDate('created_at', '2016-12-31')
                ->get();
                $users = DB::table('users')
                ->whereMonth('created_at', '12')
                ->get();
                $users = DB::table('users')
                ->whereDay('created_at', '31')
                ->get();
                $users = DB::table('users')
                ->whereYear('created_at', '2016')
                ->get();
                $users = DB::table('users')
                ->whereTime('created_at', '=', '11:20:45')
                ->get();
                $users = DB::table('users')
                ->whereColumn('first_name', 'last_name')
                ->get();
                $users = DB::table('users')
                ->whereColumn('updated_at', '>', 'created_at')
                ->get();
                $users = DB::table('users')
                ->whereColumn([
                    ['first_name', '=', 'last_name'],
                    ['updated_at', '>', 'created_at'],
                ])->get();
                $users = DB::table('users')
           ->where('name', '=', 'John')
           ->where(function (Builder $query) {
               $query->where('votes', '>', 100)
                     ->orWhere('title', '=', 'Admin');
           })
           ->get();
           $users = DB::table('users')
           ->whereExists(function (Builder $query) {
               $query->select(DB::raw(1))
                     ->from('orders')
                     ->whereColumn('orders.user_id', 'users.id');
           })
           ->get();
           $orders = DB::table('orders')
                ->select(DB::raw(1))
                ->whereColumn('orders.user_id', 'users.id');
 
$users = DB::table('users')
                    ->whereExists($orders)
                    ->get();
                    $users = User::where(function (Builder $query) {
    $query->select('type')
        ->from('membership')
        ->whereColumn('membership.user_id', 'users.id')
        ->orderByDesc('membership.start_date')
        ->limit(1);
}, 'Pro')->get();
$incomes = Income::where('amount', '<', function (Builder $query) {
    $query->selectRaw('avg(i.amount)')->from('incomes as i');
})->get();
$users = DB::table('users')
           ->whereFullText('bio', 'web developer')
           ->get();
           $users = DB::table('users')
                ->orderBy('name', 'desc')
                ->get();
                $users = DB::table('users')
                ->orderBy('name', 'desc')
                ->orderBy('email', 'asc')
                ->get();
                $user = DB::table('users')
                ->latest()
                ->first();
                $randomUser = DB::table('users')
                ->inRandomOrder()
                ->first();
                $query = DB::table('users')->orderBy('name');
 
$unorderedUsers = $query->reorder()->get();
$users = DB::table('users')
                ->groupBy('account_id')
                ->having('account_id', '>', 100)
                ->get();
                $report = DB::table('orders')
                ->selectRaw('count(id) as number_of_orders, customer_id')
                ->groupBy('customer_id')
                ->havingBetween('number_of_orders', [5, 15])
                ->get();
                $users = DB::table('users')
                ->groupBy('first_name', 'status')
                ->having('account_id', '>', 100)
                ->get();
                $users = DB::table('users')->skip(10)->take(5)->get();
                $users = DB::table('users')
                ->offset(10)
                ->limit(5)
                ->get();
                $role = $request->string('role');
 
$users = DB::table('users')
                ->when($role, function (Builder $query, string $role) {
                    $query->where('role_id', $role);
                })
                ->get();
                $sortByVotes = $request->boolean('sort_by_votes');
 
$users = DB::table('users')
                ->when($sortByVotes, function (Builder $query, bool $sortByVotes) {
                    $query->orderBy('votes');
                }, function (Builder $query) {
                    $query->orderBy('name');
                })
                ->get();
}
}