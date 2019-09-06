@extends(config('cms')?'cms::layouts.default':'MultiAuth::layouts.admin')

@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Admin Dashboard</div>
                    <div class="card-body">
                        You are logged in as Admin!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
