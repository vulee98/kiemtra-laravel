<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Thêm dòng này

class PtController extends Controller
{
    //---giai pt bac nhat controllrer
    public function getGiaiptb1()
    {
        return view('giaipt');
    }

    public function giaiptb1(Request $req)
    {
        $validator = Validator::make($req->all(), [ // Thay $validated thành $validator
            'hsa' => 'required|numeric',
            'hsb' => 'required|numeric',
        ], [
            'hsa.required' => 'Hệ số a không được để trống',
            'hsa.numeric' => 'Hệ số a phải là số',
            'hsb.required' => 'Hệ số b không được để trống',
            'hsb.numeric' => 'Hệ số b phải là số',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $a = $req->hsa;
        $b = $req->hsb;

        if ($a == 0) {
            if ($b == 0) {
                $ketqua = "Phương trình vô số nghiệm";
            } else {
                $ketqua = "Phương trình vô nghiệm";
            }
        } else {
            $ketqua = "Phương trình có nghiệm x=" . (-$b / $a);
        }

        return view('giaipt', compact('ketqua', 'a', 'b'));
    }
}
