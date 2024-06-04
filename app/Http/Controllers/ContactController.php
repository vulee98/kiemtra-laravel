<?php

namespace App\Http\Controllers;

use App\Mail\ReplyMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function contact() {

        // Lấy tất cả dữ liệu từ bảng contacts
        $contacts = Contact::all();


        return view('banhang.contact',compact('contacts'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'your-name' => 'required|string|max:255',
            'your-email' => 'required|email|max:255',
            'your-subject' => 'nullable|string|max:255',
            'your-message' => 'required|string',
        ]);

        // Lưu dữ liệu vào database
        $contact = new Contact();
        $contact->name = $validated['your-name'];
        $contact->email = $validated['your-email'];
        $contact->subject = $validated['your-subject'] ?? '';
        $contact->message = $validated['your-message'];
        $contact->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Đã Gửi thành công!!');
    }

    public function getcontact_list() {

        // Lấy tất cả dữ liệu từ bảng contacts
        $contacts = Contact::all();


        return view('admin.contact.contact-list',compact('contacts'));
    }

    public function getContactReply($id) {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.contact-reply', compact('contact'));
    }
    
    public function postContactReply(Request $request, $id) {
        $request->validate([
            'reply_message' => 'required|string',
        ]);
    
        $contact = Contact::findOrFail($id);
        $replyMessage = $request->input('reply_message');
    
        // Gửi email
        Mail::to($contact->email)->send(new ReplyMail($contact, $replyMessage));
    
        // Cập nhật trạng thái đã phản hồi
        $contact->is_replied = true;
        $contact->save();
    
        return redirect()->route('admin.contact-list')->with('success', 'Rep cmt thành công!');
    }
    

}