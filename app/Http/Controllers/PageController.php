<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class PageController extends Controller
{
    //
    public function index(){
        $new_products=Product::where('new',1)->get();
        return view('banhang.index',compact('new_products'));
    }

    public function getProduct($id)
    {
        // Lấy sản phẩm theo ID
        $new_product = Product::find($id);

        // Trả về view với thông tin sản phẩm
        return view('banhang.product', compact('new_product'));
    }

    public function addToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
     }

     public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }


    public function getCheckout(){
        return view('banhang.checkout');
    }

    public function postCheckout(Request $request){
    
        $cart=Session::get('cart');
        $customer=new Customer();
        $customer->name=$request->input('name');
        $customer->gender=$request->input('gender');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->phone_number=$request->input('phone_number');
        $customer->note=$request->input('notes');
        $customer->save();

        $bill=new Bill();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->input('payment_method');
        $bill->note=$request->input('notes');
        $bill->save();

        foreach($cart->items as $key=>$value)
        {
            $bill_detail=new BillDetail();
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Đặt hàng thành công');

    }



    public function getSigup(){
       
        return view('banhang.dangky');
    }

    public function postSigup(Request $req)
{
    // Validate input data
    $validatedData = $req->validate(
        [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'name' => 'required',
            'repassword' => 'required|same:password'
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repassword.same' => 'Mật khẩu không giống nhau',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'name.required' => 'nhập đầy đủ họ tên'
        ]
    );

    // Create new user instance
    $user = new User();
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->password = Hash::make($validatedData['password']);
    $user->phone = $req->phone;
    $user->address = $req->address;
    $user->level = 3; // level=1: admin; level=2: kỹ thuật; level=3: khách hàng
    $user->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Tạo tài khoản thành công');
}


public function getLogin()
    {
        return view('banhang.login'); // Đảm bảo rằng bạn có view `auth.login`
    }

    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/index'); // Điều hướng tới trang sau khi đăng nhập thành công
        }

        // Đăng nhập thất bại
        return redirect()->back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->intended('dangnhap');
    }

    //hàm get ra view
public function getInputEmail(){
    return view('emails.input-email');
}

//hàm xử lý gửi email
public function postInputEmail(Request $req){
    $email=$req->txtEmail;
    //validate

    // kiểm tra có user có email như vậy không
    $user=User::where('email',$email)->get();
    //dd($user);
    if($user->count()!=0){
        //gửi mật khẩu reset tới email
        $sentData = [
            'title' => 'Mật khẩu mới của bạn là:',
            'body' => '123456'
        ];
        Mail::to($email)->send(new \App\Mail\SendMail($sentData));
        Session::flash('message', 'Send email successfully!');
        return view('banhang.login');  //về lại trang đăng nhập của khách
    }
    else {
          return redirect()->route('getInputEmail')->with('message','Your email is not right');
    }
}//hết postInputEmail
}
