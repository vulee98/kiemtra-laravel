<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PtController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminLoginMiddleware;

Route::get('/', function () {
    return view('welcome');
  
});


Route::get('/hello1', function () {
    return "<h1 style='color:red;text-align:center'>Hello LÊ VŨ 1</h1>";
    
});
Route::get('/hello2', function () {
    return view('hello');
    
});

Route::get('/quayso', function () {
    return view('quayso');
    
});
//bai giai phương trình
// Route::get('/giaiptb1', function () {
//     return view('giaiptb1');
// });
Route::get('/giaipt',[PtController::class,'getGiaiptb1'])->name('getgiaiptb1');

// Route::post('/giaiptb1', function (Request $req) {
//     $a = $req->hsa;
//     $b = $req->hsb;
//     if($a == 0)
//         if($b == 0)
//             $ketqua="Phương trình vô số nghiệm";
//         else $ketqua ="Phương trình vô nghiệm";
//     else $ketqua = "Phương trình có nghiệm x=".-$b/$a;    

//     return view('giaiptb1', compact('ketqua','a','b'));
// })->name('postgiaiptb1');

Route::post('/giaipt',[PtController::class, 'giaiptb1'])->name('postgiaiptb1');

Route::resource('cars',CarController::class);

// Route::get('/cars/editcar', 'CarController@create')->name('cars.editcar');

/* tương dương 7 route sau:
Route::get('cars',[Carcontroller::class,'index'])->name('cars.index');
Route::post('cars',[Carcontroller::class,'store'])->name('cars.store');
Route::get('cars/create',[Carcontroller::class,'create'])->name('cars.create');
Route::get('cars/car',[Carcontroller::show,'show'])->name('cars.show');
Route::put('cars/car',[Carcontroller::update,'update'])->name('cars.update');
Route::delete('cars/car',[Carcontroller::destroy,'destroy'])->name('cars.destroy');
Route::get('cars/car/edit',[Carcontroller::edit,'edit'])->name('cars.edit');
*/
Route::post('/cars/search', [CarController::class, 'postSearch'])->name('cars.search');


Route::get('/cars', [CarController::class, 'index'])->name('cars.index');



// route : bán hàng ---------------------------------------------------------------------------

Route::get('index',[PageController::class,'index'])->name('banhang.index');
Route::get('product/{id}', [PageController::class, 'getProduct'])->name('product.get');
Route::get('add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');
// Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('del-cart/{id}',[PageController::class,'delCartItem'])->name('banhang.xoagiohang');


Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');//sau khi đã định nghĩa


Route::get('dangky',[PageController::class,'getSigup'])->name('getsigup');
Route::post('dangky',[PageController::class,'postSigup'])->name('postsigup');



Route::get('dangnhap', [PageController::class, 'getLogin'])->name('getlogin');
Route::post('dangnhap', [PageController::class, 'postLogin'])->name('postlogin');

Route::get('logout', [PageController::class, 'getLogout'])->name('getlogout');

///admin


// Route::get('/cate_list', function () {
//     return view('admin.cate_list');
  
// });
// Route::get('/admin/category-list', [CategoryController::class, 'getCateList'])->name('admin.category.list');
Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout']);

Route::prefix('admin')->group(function () {
    Route::middleware([AdminLoginMiddleware::class])->group(function () {
        Route::group(['prefix'=>'category'],function(){
             // admin/category/danhsach
             Route::get('danhsach',[CategoryController::class,'getCateList'])->name('admin.getCateList');
             Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
             Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
             Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
             Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
             Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
         });
   //viết tiếp các route khác cho crud products, users,.... thì viết tiếp
   });
 });

 Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');
 Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');



 //contact

Route::get('/contact',[ContactController::class,'contact'])->name('banhang.contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('admin/contact-reply/{id}', [ContactController::class, 'getContactReply'])->name('admin.contact-reply');

Route::post('admin/contact-reply/{id}', [ContactController::class, 'postContactReply'])->name('admin.contact-reply.submit');
