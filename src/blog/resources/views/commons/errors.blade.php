@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
        <strong>@lang('home.lbWhoop')</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('message'))
    <div class="col-lg-12">
        <div class="alert alert-{!! Session::get('flag') !!}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            {!! Session::get('message') !!}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif
