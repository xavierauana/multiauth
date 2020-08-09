@extends(config('cms')?'cms::layouts.default':'MultiAuth::layouts.admin')

@section('content')
    <div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <h5 class="card-header">Admin Dashboard</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            You are logged in as Admin!
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
