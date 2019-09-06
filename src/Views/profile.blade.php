@extends("MultiAuth::layouts.admin")

@section("content")
	<div class="container">
		{!! Form::model($admin,['url'=>route('admin.profile'), 'method'=>'PUT'])!!}
		<div class="form-group">
			{{Form::label('name','Name',['class'=>'form-label'])}}
			{{Form::text('name',null,['class'=>$errors->has('name')?"form-control is-invalid":"form-control","required"])}}
			@if ($errors->has('name'))
				<span class="invalid-feedback">
		          <strong>{{ $errors->first('name') }}</strong>
		      </span>
			@endif
		</div>
		<div class="form-group">
			{{Form::label('email','Email',['class'=>'form-label'])}}
			{{Form::email('email',null,['class'=>$errors->has('email')?"form-control is-invalid":"form-control","required"])}}
			@if ($errors->has('email'))
				<span class="invalid-feedback">
		          <strong>{{ $errors->first('email') }}</strong>
		      </span>
			@endif
		</div>
		<div class="form-group">
			{{Form::label('password','Password',['class'=>'form-label'])}}
			{{Form::password('password',['class'=>$errors->has('password')?"form-control is-invalid":"form-control"])}}
			@if ($errors->has('password'))
				<span class="invalid-feedback">
		          <strong>{{ $errors->first('password') }}</strong>
		      </span>
			@endif
		</div>
		<div class="form-group">
			{{Form::label('password_confirmation','Confirm Password',['class'=>'form-label'])}}
			{{Form::password('password_confirmation',['class'=>$errors->has('password_confirmation')?"form-control is-invalid":"form-control"])}}
			@if ($errors->has('password_confirmation'))
				<span class="invalid-feedback">
		          <strong>{{ $errors->first('password_confirmation') }}</strong>
		      </span>
			@endif
		</div>
		
		<div class="form-group">
			<button class="btn btn-success">Update</button>
			<a class="btn btn-info" href="{{'/admin'}}">Back</a>
		</div>
		
		{!! Form::close() !!}
	</div>

@endsection