<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhatweController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FactoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BackImageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ProductModelController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\SisterConcernController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\CompanyProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/get-product/{category}', [HomeController::class, 'getProductByCategory']);
Route::get('/get-model/{model}', [HomeController::class, 'getProductByModel']);
Route::get('/product/category/{id}', [HomeController::class, 'catwithProduct'])->name('cat-product');
Route::get('/product-detail/{id}', [HomeController::class, 'productDetail'])->name('product-detail');

// search route
Route::get('/get_suggestions/{k}/{cat}', [HomeController::class, 'getSearchSuggestions']);
Route::get('/search', [HomeController::class, 'productSearch'])->name('search');
// Route::get('/search', [HomeController::class, 'productSearch'])->name('search');

Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/activity', [HomeController::class, 'activity'])->name('activity');
Route::get('/sister-concern', [HomeController::class, 'sister_concern'])->name('sister-concern');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/gallery/event/{id}', [HomeController::class, 'eventwithGallery'])->name('event-gallery');

Route::get('/video', [HomeController::class, 'video'])->name('video');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/webnews', [HomeController::class, 'webnews'])->name('webnews');
Route::get('/webnews-detail/{id}', [HomeController::class, 'webnewsDetail'])->name('webnews-detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store/', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/update/', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'cartRemove'])->name('cart.remove');

Route::get('/order-placed', [CheckoutController::class, 'checkoutstore']);


// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/store', [CheckoutController::class, 'checkoutstore'])->name('checkout.store');
// contact route
Route::post('/contact-store', [ContactController::class, 'store'])->name('contact.store');

// login
Route::get('admin', [AuthenticationController::class, 'login'])->name('login');
Route::post('admin', [AuthenticationController::class, 'AuthCheck'])->name('login.check');

Route::group(['middleware' => ['auth']] , function() {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // logout
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::put('/admin', [AuthenticationController::class, 'passwordUpdate'])->name('password.change');
    // company profile 
    Route::get('company-profile', [CompanyProfileController::class, 'edit'])->name('company.edit');
    Route::put('company-profile/{company}', [CompanyProfileController::class, 'update'])->name('company.update');

    // Create user
    Route::get('/registration', [RegistrationController::class, 'index'])->name('register.create');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('register.store');

    Route::get('/settings', [RegistrationController::class, 'settings'])->name('settings');
    Route::put('/registration', [RegistrationController::class, 'profileUpdate'])->name('register.update');

    // contact list
    Route::get('/contact-list', [ContactController::class, 'index'])->name('contact.list');
    Route::get('/contact-delete/{id}', [ContactController::class, 'destroy'])->name('contact.delete');

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');
    // Product Model
    Route::get('/product-model', [ProductModelController::class, 'index'])->name('admin.model');
    Route::post('/product-model/store', [ProductModelController::class, 'store'])->name('admin.model.store');
    Route::get('/product-model/edit/{id}', [ProductModelController::class, 'edit'])->name('admin.model.edit');
    Route::post('/product-model/update/{id}', [ProductModelController::class, 'update'])->name('admin.model.update');
    Route::get('/product-model/delete/{id}', [ProductModelController::class, 'destroy'])->name('admin.model.delete');

    Route::get('/unit', [UnitController::class, 'index'])->name('admin.unit');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('admin.unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('admin.unit.edit');
    Route::post('/unit/update/{id}', [UnitController::class, 'update'])->name('admin.unit.update');
    Route::get('/unit/delete/{id}', [UnitController::class, 'destroy'])->name('admin.unit.delete');

    // Subcategory Routes
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('admin.subcategories');
    Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.delete');

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');
    Route::get('/product/subcategory/get/{subcat_id}', [ProductController::class, 'getSubCate'])->name('admin.product.get.subcat');

    // Service Route
    Route::get('/services', [ServiceController::class, 'service'])->name('service');
    Route::post('service/insert', [ServiceController::class, 'serviceInsert'])->name('store.service');
    Route::get('service/edit/{id}', [ServiceController::class, 'serviceEdit'])->name('edit.service');
    Route::post('service/update/{id}', [ServiceController::class, 'serviceUpdate'])->name('update.service');
    Route::get('service/delete/{id}', [ServiceController::class, 'serviceDelete'])->name('delete.service');
    
    // Service Route
    Route::get('/sister', [SisterConcernController::class, 'index'])->name('sister');
    Route::post('sister/insert', [SisterConcernController::class, 'store'])->name('store.sister');
    Route::get('sister/edit/{id}', [SisterConcernController::class, 'edit'])->name('edit.sister');
    Route::post('sister/update/{id}', [SisterConcernController::class, 'update'])->name('update.sister');
    Route::get('sister/delete/{id}', [SisterConcernController::class, 'delete'])->name('delete.sister');
    // Events Route
    Route::get('/event', [EventController::class, 'index'])->name('admin.event');
    Route::post('/event/store', [EventController::class, 'store'])->name('admin.event.store');
    Route::get('/event/edit/{id}', [EventController::class, 'edit'])->name('admin.event.edit');
    Route::post('/event/update/{id}', [EventController::class, 'update'])->name('admin.event.update');
    Route::get('/event/delete/{id}', [EventController::class, 'destroy'])->name('admin.event.delete');
    // Gallery Route
    Route::get('/galleries', [GalleryController::class, 'gallery'])->name('galleries');
    Route::post('gallery/insert', [GalleryController::class, 'galleryInsert'])->name('store.gallery');
    Route::get('gallery/edit/{id}', [GalleryController::class, 'galleryEdit'])->name('edit.gallery');
    Route::post('gallery/update/{id}', [GalleryController::class, 'galleryUpdate'])->name('update.gallery');
    Route::get('gallery/delete/{id}', [GalleryController::class, 'galleryDelete'])->name('delete.gallery');
    
    // Video Route
    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
    Route::post('video/insert', [VideoController::class, 'store'])->name('store.video');
    Route::get('video/edit/{id}', [VideoController::class, 'edit'])->name('edit.video');
    Route::post('video/update/{id}', [VideoController::class, 'update'])->name('update.video');
    Route::get('video/delete/{id}', [VideoController::class, 'delete'])->name('delete.video');

    // News Route
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::post('news/insert', [NewsController::class, 'store'])->name('store.news');
    Route::get('news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::get('news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');


    // Management Route
    Route::get('managements', [ManagementController::class, 'index'])->name('management.index');
    Route::post('management/store', [ManagementController::class, 'store'])->name('management.store');
    Route::get('management/edit/{id}', [ManagementController::class, 'edit'])->name('management.edit');
    Route::post('management/update/{id}', [ManagementController::class, 'update'])->name('management.update');
    Route::get('management/delete/{id}', [ManagementController::class, 'delete'])->name('management.delete');

    Route::get('sliders', [SliderController::class, 'index'])->name('slider.index');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('slider/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');

    Route::get('factory', [FactoryController::class, 'edit'])->name('edit.factory');
    Route::post('factory/{id}', [FactoryController::class, 'update'])->name('update.factory');
    Route::get('factorypoint/{id}', [FactoryController::class, 'editpoint'])->name('edit.factorypoint');
    Route::post('factorypoint/update/{id}', [FactoryController::class, 'pointupdate'])->name('update.factorypoint');
    Route::get('factorypoint/delete/{id}', [FactoryController::class, 'pointdelete'])->name('delete.factorypoint');

    Route::get('whatwe', [WhatweController::class, 'edit'])->name('whatwe.edit');
    Route::put('whatwe/{whatwe}', [WhatweController::class, 'update'])->name('whatwe.update');

    Route::get('backimage', [BackImageController::class, 'edit'])->name('backimage.edit');
    Route::put('backimage/{backimage}', [BackImageController::class, 'update'])->name('backimage.update');

    Route::get('/messages', [MessageController::class, 'index'])->name('admin.message');
    Route::get('messages/delete/{id}', [MessageController::class, 'destroy'])->name('delete.message');
    
    Route::get('/queries', [QueryController::class, 'query'])->name('admin.query');
    Route::get('queries/delete/{id}', [QueryController::class, 'queryDelete'])->name('admin.query.delete');

    Route::resource('/partner', PartnerController::class)->except('show', 'create');
	
    //testimonial
    Route::get('/our-testimonial',[TestimonialController::class,'index'])->name('testimonial.index');
    Route::post('/our-testimonial-store',[TestimonialController::class,'store'])->name('testimonial.store');
    Route::get('/our-testimonial-edit/{id}',[TestimonialController::class,'edit'])->name('testimonial.edit');
    Route::put('/our-testimonial-update/{id}',[TestimonialController::class,'update'])->name('testimonial.update');
    Route::get('/our-testimonial-delete/{id}',[TestimonialController::class,'destroy'])->name('testimonial.destroy');
    
    //faq
    Route::get('/faqs',[FaqController::class,'index'])->name('faq.index');
    Route::post('/faq-store',[FaqController::class,'store'])->name('faq.store');
    Route::get('/faq-edit/{id}',[FaqController::class,'edit'])->name('faq.edit');
    Route::put('/faq-update/{id}',[FaqController::class,'update'])->name('faq.update');
    Route::get('/faq-delete/{id}',[FaqController::class,'destroy'])->name('faq.destroy');
    // Route::delete('/faq-delete/{id}',[FaqController::class,'destroy'])->name('faq.destroy');

    Route::get('map', [MapController::class, 'edit'])->name('map.edit');
    Route::put('map/{map}', [MapController::class, 'update'])->name('map.update');

    Route::get('/pending-orders',[OrderController::class,'pending'])->name('order.pending');
    Route::get('/pending/state/{id}',[OrderController::class,'pendingState'])->name('pending.state');

    Route::get('/completed-orders',[OrderController::class,'completed'])->name('order.completed');
    Route::get('/all-orders',[OrderController::class,'all'])->name('order.all');
    Route::get('/cancelled-orders',[OrderController::class,'cancelled'])->name('order.cancelled');
    Route::get('/delete-orders/{id}',[OrderController::class,'orderDelete'])->name('order.deleted');
    Route::get('/pdelete-orders/{id}',[OrderController::class,'orderPDelete'])->name('order.pdeleted');

    Route::get('/order/details/{id}',[OrderController::class,'orderDetail'])->name('order-details');
    

      
});


// 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
//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
