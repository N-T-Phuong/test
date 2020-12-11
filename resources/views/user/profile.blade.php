@extends('layout.admin')

@section ('content')

    <div class="container ">
			<div class="col-md-6">
				<div class="card">
		            <div class="card-header">
		                <h3 class="card-title"> Profile </h3>
		            </div>
		            <div class="card-body">
					<form action="{{route ('user.update-profile')}}" method="POST" role="form">
						@csrf <!-- dùng trong form post -->
						@method('put')
					
						<div class="form-group">
							<label for="">Email</label>
							<input type="text" name="email" class="form-control" id="" placeholder="" value="{{ old('email', Auth::user()->email)}}">
							@error('email')
							  <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="">Fullname</label>
							<input type="text" name="fullname" class="form-control" id="" placeholder="" value="{{old('fullname', Auth::user()->fullname )}}">
						</div>
						
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
						
					</form>
			    </div>
			</div>
		</div>
	</div>

@endsection