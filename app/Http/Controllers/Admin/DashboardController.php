<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Slider;
use App\Models\Query;



class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        $users = count(User::all());
        $slider = count(Slider::all());
        $product = count(Product::all());
        $category = count(Category::all());
        return view('pages.admin.home', compact('users', 'slider', 'product','category'));
    }
}
