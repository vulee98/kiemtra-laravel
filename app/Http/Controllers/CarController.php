<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\car;
use App\Models\Mf;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Lấy danh sách tất cả các xe từ cơ sở dữ liệu
          $cars = Car::paginate(3); 
          $manufacturers = Mf::all(); // Lấy danh sách các hãng xe
          $totalCars = Car::count();
          return view('index', compact('cars', 'manufacturers','totalCars'));
          
    
    }
    
   
    public function create()
    {
        $mfs=Mf::all();
        return view('create',compact('mfs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "produced_on"  => "required|date",
            "mf_id" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect('cars/create')->withErrors($validation)->withInput();
        }
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $car=new Car();
        $car->description=$request->input('description');
        $car->model=$request->input('model');
        $car->produced_on=$request->input('produced_on');
        $car->mf_id=$request->input('mf_id');
        $car->image=$name;
        $car->save();
        return redirect('cars')->with('message','Thêm xe thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
   
        
            $car = Car::find($id);
            // dd($car); 
            return view('show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
    
        $car = Car::find($id); // Tìm kiếm xe theo ID
        
      
        
        return view('edit', compact('car')); // Trả về view 'editcar' với dữ liệu xe
    }


    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'description' => 'required',
            'model' => 'required',
            'produced_on' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Kiểm tra hình ảnh mới
        ]);
    
        // Tìm xe cần cập nhật
        $car = Car::findOrFail($id);
    
        // Cập nhật các trường dữ liệu
        $car->description = $request->description;
        $car->model = $request->model;
        $car->produced_on = $request->produced_on;
    
        // Xử lý hình ảnh mới nếu có
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $car->image = $imageName;
        }
    
        // Lưu thay đổi vào cơ sở dữ liệu
        $car->save();
    
        // Thông báo thành công
        session()->flash('message', 'Cập nhật thông tin Xe thành công');
    
        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $car=Car::find($id);
        $linkImage=public_path('images/').$car->image;
         if (File::exists($linkImage)) {
        // Nếu có, xóa hình ảnh
        File::delete($linkImage);
    }
        $car->delete();     
        return redirect()->back()->with('message','Bạn đã xóa thành công');
    }


    public function postSearch(Request $req){
        $search_value = $req->txtSearch;
        $mfs_array = Mf::select('id')->where('mf_name', 'like', '%' . $search_value . '%')->get()->toArray();
    
        $cars_search = Car::where('model', 'like', '%' . $search_value . '%')
                          ->orWhere('description', 'like', '%' . $search_value . '%')
                          ->orWhereIn('mf_id', $mfs_array)
                          ->get();
                          
        
        return view('index', compact('cars_search'));
    }
    
}

