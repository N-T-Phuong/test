@extends('layout.admin')

@section ('content')   
    <div class="container ">
		<div class="row mt-20">
			<div class="col-md-6">
				<div class="card">
		            <div class="card-header">
		                <h3 class="card-title">Create New</h3>
		            </div>
		            <div class="card-body">
					<form action="{{route ('posts.store')}}" method="POST" role="form">
						@csrf <!-- dùng trong form post -->
						
					
						<div class="form-group">
							<label for="">Title</label>
							<input type="text" name="title" class="form-control" id="" placeholder="">
						</div>
						<div class="form-group">
							<label for="">Content</label>
							<input type="text" name="content" class="form-control mce" id="" placeholder="">
						</div>
						<div class="form-group">
							<label for="">Category</label>
							<select name="category_id" id="input" class="form-control" required="required">
								<option value="">Chọn</option>
								@foreach ($categories as $category)
								    <option value="{{ $category->id}}">{{$category->name}}</option>
								@endforeach
							</select>
							
						</div>
						<div class="form-group">
							<label for="">Tag</label>
							

							<select name="tags[]" id="input" class="form-control select2" required="multiple">
								<option value=""></option>
								@foreach ($tags as $tag)
								    <option value="{{ $tag->id}}">{{ $tag->name }}</option>
								@endforeach
							</select>
							
						</div>
						<div class="form-group">
							<label for="">Status</label>
							<select name="status" id="inputStatus" class="form-control" required="required">
								<option value="1">public</option>
								<option value="2">protected</option>
							</select>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Create posts</button>
						</div>
						
					</form>
			    </div>
			</div>
		</div>
	</div>

@endsection