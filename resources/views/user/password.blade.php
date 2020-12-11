@extends('layout.admin')

@section ('content')

    <div class="container">
    	@if (Session('error'))
		    <div class="alert alert-danger">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      <strong>Thông báo!</strong> {{Session('error')}}
		    </div>
		  @endif
		  @if (Session('success'))
		    <div class="alert alert-success">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      <strong>Thông báo!</strong> {{Session('success')}}
		    </div>
		  @endif
			<div class="col-md-6">
				<div class="card mt-4">
		            <div class="card-header">
		                <h3 class="card-title"> ChangePassword </h3>
		            </div>
		            <div class="card-body">
					<form action="{{route ('user.up-password')}}" method="POST" role="form">
						@csrf <!-- dùng trong form post -->
						@method('put')
					
						<div class="form-group">
							<label for="">Mật khẩu cũ</label>
							<input type="password" name="password" class="form-control" id="" placeholder="" value="{{ old('password', Auth::user()->password)}}">
							@error('password')
							  <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="">Mật khẩu mới</label>
							<input type="password" name="pass_new" class="form-control" id="" placeholder="" value="">
							@error('pass_new')
							  <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="">Nhập lại mật khẩu</label>
							<input type="password" name="confirm_pass" class="form-control" id="" placeholder="" value="">
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