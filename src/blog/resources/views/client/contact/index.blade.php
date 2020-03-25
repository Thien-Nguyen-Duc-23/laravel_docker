@extends('client.layout.app')

@section('content')
    <div class="banner">
        <!-- google maps start -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.2803951558517!2d108.2034673148582!3d16.050932988892235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219bbac29a89b%3A0xd1216d40b4bca153!2zMTUwIER1eSBUw6JuLCBIw7JhIFRodeG6rW4gTmFtLCBI4bqjaSBDaMOidSwgxJDDoCBO4bq1bmcgNTUwMDAw!5e0!3m2!1svi!2s!4v1559463210521!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <!-- google maps end -->
    </div>
    <section class="main-container">
        <div class="container-fluid">
            <div class="container">
                <div class="formBox">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <h1>@lang('home.lbContact')</h1>
                            </div>
                        </div>
                        @include('commons.errors')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="inputBox ">
                                    <div class="inputText">@lang('home.lbNameContact')</div>
                                    <input type="text" name="fullName" value="{{ old('fullName') }}" class="input">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inputBox">
                                    <div class="inputText">@lang('home.lbEmailContact')</div>
                                    <input type="text" name="email" value="{{ old('email') }}" class="input">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="inputBox">
                                    <div class="inputText">@lang('home.lbSubject')</div>
                                    <input type="text" name="subject" value="{{ old('subject') }}" class="input">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inputBox">
                                    <div class="inputText">@lang('home.lbMessage')</div>
                                    <textarea type="text" name="message" class="input" rows="5">{!! old('message') !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="inputBox">
                                    <div class="inputText">@lang('home.lbRecaptcha'):</div>
                                    <div class="col-sm-6 fix-capcha">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="buttonContact">@lang('home.btnSendMessage')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
