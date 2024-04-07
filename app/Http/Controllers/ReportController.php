<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
        public function index()
    {
        $users = User::all();
        
        // Phương thức append
        $users2 = User::take(2)->get()->map(function ($user) {
            $user->append(['team', 'is_admin']);
            return $user;
        });
        
        // Phương thức contains
        $containsUser = $users->contains(3);
        $containsUserModel = $users->contains(User::find(3));
        
        // Phương thức diff
        $diffUsers = $users->diff(User::whereIn('id', [1, 2, 3])->get());
        
        // Phương thức except
        $exceptUsers = $users->except([4, 5]);
        
        // Phương thức fresh
        $fresh= $users->fresh();
        
        // Phương thức intersect
        $intersectUsers = $users->intersect(User::whereIn('id', [6, 7, 8])->get());

        // Phương thức load
        $users->load(['posts']);
        $user_post= $users->load(['posts' => fn ($query) => $query->where('active', 1)]);
        
        // Phương thức loadMissing
        $users->loadMissing(['posts']);
        $user_miss=$users->loadMissing(['posts' => fn ($query) => $query->where('active', 1)]);
        
        // Phương thức modelKeys
        $modelKeys = $users->modelKeys();

        // Phương thức makeVisible
        $users_makeVi = $users->makeVisible(['address', 'phone_number']);

        // Phương thức makeHidden
        $users_make = $users->makeHidden(['address', 'phone_number']);

        // Phương thức only
        $users_only = $users->only([1, 2, 3]);

        // Phương thức setVisible
        $users_setVi = $users->setVisible(['id', 'name']);
        
        // Phương thức setHidden
        $users_hidd = $users->setHidden(['email', 'password', 'remember_token']);
    
        // Phương thức unique
        $uniqueUsers = $users->unique();
        
        $users_count = DB::table('users')->count();
        $price = DB::table('orders')->max('price');

        $results = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.*', 'orders.*')
        ->get();
        $results_gb = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.id', 'users.name', DB::raw('COUNT(orders.id) as order_count'))
        ->groupBy('users.id', 'users.name')
        ->get();
        $users_up = DB::table('users')
                ->whereColumn('updated_at', '>', 'created_at')
                ->get();

        return view('page.report.index', compact(
            'users2', 'containsUser', 'containsUserModel', 'diffUsers', 'exceptUsers', 
            'fresh', 'intersectUsers', 'user_post', 'user_miss', 'users_makeVi', 
            'users_make', 'users_only', 'users_setVi', 'users_hidd', 'uniqueUsers', 'users_count', 'price', 'results', 'results_gb', 'users_up'
        ));
    }

}