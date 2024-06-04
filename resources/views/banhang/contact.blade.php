@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Contact Form</h2>
            <div class="space20">&nbsp;</div>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit ani m id est laborum.</p>
            <div class="space20">&nbsp;</div>
            <form action="#" method="post" class="contact-form">	
                @csrf
                <div class="form-block">
                    <input name="your-name" type="text" placeholder="Your Name (required)" value="{{ old('your-name') }}">
                    @error('your-name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-block">
                    <input name="your-email" type="email" placeholder="Your Email (required)" value="{{ old('your-email') }}">
                    @error('your-email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-block">
                    <input name="your-subject" type="text" placeholder="Subject" value="{{ old('your-subject') }}">
                    @error('your-subject')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-block">
                    <textarea name="your-message" placeholder="Your Message">{{ old('your-message') }}</textarea>
                    @error('your-message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-block">
                    <button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <h2>Contact Information</h2>
            <div class="space20">&nbsp;</div>
            <h6 class="contact-title">Address</h6>
            <p>
                Suite 127 / 267 – 277 Brussel St,<br>
                62 Croydon, NYC <br>
                Newyork
            </p>
            <div class="space20">&nbsp;</div>
            <h6 class="contact-title">Business Enquiries</h6>
            <p>
                Doloremque laudantium, totam rem aperiam, <br>
                inventore veritatio beatae. <br>
                <a href="mailto:biz@betadesign.com">biz@betadesign.com</a>
            </p>
            <div class="space20">&nbsp;</div>
            <h6 class="contact-title">Employment</h6>
            <p>We’re always looking for talented persons to <br>
                join our team. <br>
                <a href="mailto:hr@betadesign.com">hr@betadesign.com</a>
            </p>
        </div>
    </div>

    <!-- Hiển thị danh sách email và message dạng comment -->
    <div class="space50">&nbsp;</div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Comment</h2>
            <div class="space20">&nbsp;</div>
            
            @if($contacts->isEmpty())
                <p>No messages found.</p>
            @else
                @foreach($contacts as $contact)
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading" style="font-size: 15px;">{{ $contact->email }}</h4>
                            <p>{{ $contact->message }}</p>
                            <div class="space20">&nbsp;</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div> <!-- .container -->
@endsection