<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Whatwe;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\News;
use App\Models\Management;
use App\Models\BackImage;
use App\Models\Event;
use App\Models\Partner;
use App\Models\Factory;
use App\Models\FactoryPoint;
use App\Models\Service;
use App\Models\SisterConcern;
use App\Models\Faq;
use App\Models\ProductModel;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\RegularExpression;

class HomeController extends Controller
{
    public function index()
    {   
        $slider = Slider::latest()->get();
        $partner = Partner::latest()->get();
        $management = Management::latest()->get();
        $history = Whatwe::first();
        $gallery = Gallery::latest()->get();
        $video = Video::latest()->get();
        $product = Product::latest()->get();
        $factory = Factory::first();
        $factorypoint = FactoryPoint::latest()->get();
        $service = Service::latest()->get();
        $sister = SisterConcern::latest()->get();
        $news = News::latest()->get();
        $faq = Faq::latest()->get();
        $testimonial = Testimonial::latest()->get();
        return view('pages.website.index', compact('slider', 'partner', 'management', 'gallery', 'video', 'product', 'history', 'factory', 'factorypoint', 'service', 'news', 'sister', 'faq', 'testimonial'));
    }
    public function about() {
        return view('pages.website.about');
    }
    public function product() {
        $category = Category::with('product')->latest()->get();
        $model = ProductModel::latest()->get();
        // $product = Product::with('category')->latest()->get();
        return view('pages.website.product', compact('category', 'model'));
    }
    public function catwithProduct($id) {
        $category = Category::find($id);
        $product = Product::where('category_id',$id)->latest()->get();
        // return $product;
        return view('pages.website.cat-product', compact('product', 'category'));
    }
    public function productDetail($id) {
        $product = Product::find($id);
        if($product) {
            return view('pages.website.product-detail', compact('product'));
        } else {
            return view('pages.website.no-page');
        }
    }

    public function getSearchSuggestions($keyword, $id)
    {   
        if($id) {
            $product = Product::select('name')
            ->where('name', 'like', "%$keyword%")
            ->where('category_id', $id)
            ->get()->toArray();
        }
        else {
            $product = Product::select('name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();
        }
        // $product = Product::select('name')
        //     ->where('name', 'like', "%$keyword%")
        //     ->get()->toArray();

        // $product1 = Product::select('name')->where('name', 'like', "$keyword%")->get()->toArray();

        // $category = Category::select('name as name')
        //     ->where('name', 'like', "%$keyword%")
        //     ->get()->toArray();

        // $model = ProductModel::select('name as name')
        //     ->where('name', 'like', "%$keyword%")
        //     ->get()->toArray();

        // $mergedArray = array_merge($product, $category, $model, $product1);

        $search_results = [];

        foreach ($product as $sr) {
            $search_results[] = $sr['name'];
        }

        return response()->json($search_results);
    }

    public function productSearch()
    {
        if (request()->query('q')) {
            $categories = Category::all();
            $keyword = request()->query('q');
            $search_result = Product::Where('name', 'like', "$keyword%")->get();
            // $search2 = Product::where('name', 'like', "$keyword%")->get();
            $catid = request()->query('category');

            return view('pages.website.search', compact('search_result', 'keyword','categories', 'catid'));
        }

        return redirect()->back();
    }

    public function history() {
        $history = Whatwe::first();
        return view('pages.website.history', compact('history'));
    }
    public function activity() {
        $activity = Whatwe::first();
        return view('pages.website.activity', compact('activity'));
    }
    public function sister_concern() {
        $sister = SisterConcern::latest()->get();
        return view('pages.website.sister-concern', compact('sister'));
    }
    public function faq() {
        $faq = Faq::latest()->get();
        return view('pages.website.faq', compact('faq'));
    }
    public function gallery() {
        $event = Event::latest()->get();
        // $gallery = Gallery::latest()->get();
        return view('pages.website.gallery', compact('event'));
    }
    public function eventwithGallery($id) {
        $event = Event::find($id);
        $gallery = Gallery::where('event_id', $id)->latest()->get();
        return view('pages.website.event-gallery', compact('gallery', 'event'));
    }
    public function video() {
        $video = Video::latest()->get();
        return view('pages.website.video', compact('video'));
    }
    public function team() {
        $management = Management::latest()->get();
        return view('pages.website.team', compact('management'));
    }
    public function webnews() {
        $news = News::latest()->get();
        return view('pages.website.news', compact('news'));
    }
    public function webnewsDetail($id) {
        $news = News::find($id);
        if($news) {
            return view('pages.website.news-details', compact('news'));
        } else {
            return view('pages.website.no-page');
        }
    }
    // public function order($id) {
    //     $product = Product::find($id);
    //     if($product) {
    //         return view('pages.website.order', compact('product'));
    //     } else {
    //         return view('pages.website.no-page');
    //     }
    // }
    // public function submenu($id) {
    //     $category = Category::find($id);
    //     if (isset($category)) {
    //         $subcategory = Subcategory::where('category_id', $id)->get();
    //         $backimage = BackImage::first();
    //         return view('pages.website.submenu', compact('category', 'subcategory', 'backimage'));
    //     } else {
    //         $backimage = BackImage::first();
    //         return view('pages.website.not-found', compact('backimage'));
    //     }
    // }

    // subcategory id pass bellow
    // public function product($id) {
    //     $subcategory = Subcategory::find($id); // subcategory id retrieve which the product contain
    //     if (isset($subcategory)) {
    //         $category = Category::where('id', $subcategory->category_id)->first();
    //         $product = Product::where('subcategory_id', $id)->get();
    //         $backimage = BackImage::first();
    //         return view('pages.website.product', compact('subcategory','product', 'category', 'backimage'));
    //     } else {
    //         $backimage = BackImage::first();
    //         return view('pages.website.not-found', compact('backimage'));
    //     }
    // }

    // public function productDetail($id) {
    //     $product = Product::find( $id);
    //     $subcategory = Subcategory::where('id', $product->subcategory_id)->first();
    //     $category = Category::where('id', $product->category_id)->first();
    //     $backimage = BackImage::first();
    //     return view('pages.website.product-detail', compact('product', 'subcategory', 'category', 'backimage'));
    // }

    // public function newsDetail($id) {
    //     $news = News::find($id);
    //     if (isset($news)) {
    //         $backimage = BackImage::first();
    //         return view('pages.website.news-details', compact('news', 'backimage'));
    //     } else {
    //         $backimage = BackImage::first();
    //         return view('pages.website.not-found', compact('backimage'));
    //     }
    // }

    public function getProductByCategory($CategoryId)
    {
        if($CategoryId == 0) {
            $products = Product::get()->load('category','model');
        } else {
            $products = Product::where('category_id', $CategoryId)->get()->load('category','model');
        }
        $id = [$CategoryId];

        return view('loadhtmlpage.loadproduct', compact('products', 'id'));

        // return response()->json(['data'=> $products]);
    }

    public function getProductByModel($ModelId) {

        if($ModelId == 0) {
            $products = Product::get()->load('category','model');
        } else {
            $products = Product::where('model_id', $ModelId)->get()->load('category','model');
        }
        $id = [$ModelId];

        return view('loadhtmlpage.loadproduct', compact('products', 'id'));

    }

}
