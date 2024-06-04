@extends('layout.master')
@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng kí</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="index.html">Home</a> / <span>Đăng kí</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">

        <form action="{{ route('postsigup') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>

                @if (count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{ $err }}
                    @endforeach
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }} </div>
                @endif


                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-block">
                        <label for="name">Fullname*</label>
                        <input name="name" type="text" id="name" required>
                    </div>

                    <div class="form-block">
                        <label for="address">Address*</label>
                        <input name="address" type="text" id="address" value="Street Address" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input name="phone" type="text" id="phone" required>
                    </div>

                    <div class="form-block">
                        <label for="password">Password*</label>
                        <input name="password" type="password" id="password" required>
                    </div>

                    <div class="form-block">
                        <label for="repassword">Re password*</label>
                        <input name="repassword" type="password" id="repassword" required>
                    </div>

                    <div class="form-block">
                        <button name="register" type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>

        </form>
    </div> <!-- #content -->
</div> <!-- .container -->


<!--customjs-->
<script type="text/javascript">
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".main-menu a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).parents('li').addClass('parent-active');
            }
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        'use strict';

        // color box

        //color
        jQuery('#style-selector').animate({
            left: '-213px'
        });

        jQuery('#style-selector a.close').click(function(e) {
            e.preventDefault();
            var div = jQuery('#style-selector');
            if (div.css('left') === '-213px') {
                jQuery('#style-selector').animate({
                    left: '0'
                });
                jQuery(this).removeClass('icon-angle-left');
                jQuery(this).addClass('icon-angle-right');
            } else {
                jQuery('#style-selector').animate({
                    left: '-213px'
                });
                jQuery(this).removeClass('icon-angle-right');
                jQuery(this).addClass('icon-angle-left');
            }
        });
    });
</script>


@stop