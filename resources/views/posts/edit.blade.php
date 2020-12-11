 @extends('layout.admin')   

 @section('content')
    <div class="container ">
		<div class="row">
			<div class="col-md-6">
				<form action="{{ route('posts.update', $post->id) }}" method="POST" role="form">
					@csrf
					@method('put')
					<legend>Update</legend>
				
					<div class="form-group">
						<label for="">Title</label>
						<input type="text" name="title" value="{{ $post->title}}" class="form-control" id="" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Content</label>
						<input type="text" name="content" value="{{ $post->content}}" class="form-control" id="" placeholder="">
					</div>
					<div class="form-group">
						<label for="">Category</label>
						<select name="category_id" id="input" class="form-control" required="required">
							<option value="">Chọn</option>
							@foreach ($categories as $category)
							    <option {{ $post->category_id = $category->id ? 'selected': ''}} value="{{ $category->id}}">{{$category->name}}</option>
							@endforeach
						</select>
						
					</div>
					<div class="form-group">
						<label for="">Tag</label>
						@php
						$tagsIds = $post->tags->pluck('id')->toArray();
						@endphp

						<select name="tags[]" id="input" class="form-control select2" required="multiple">
							<option value=""></option>
							@foreach ($tags as $tag)
							    <option {{ in_array( $tag->id, $tagsIds) ? 'selected' : '' }} value="{{ $tag->id}}">{{ $tag->name }}</option>
							@endforeach
						</select>
						
					</div>
					<div class="form-group">
						<label for="">Status</label>
						<select name="status" id="input" class="form-control" required="required">
							<option  value="1" {{ $post->status == 1 ? 'selected' : '' }} >Public</option>
							<option  value="2" {{ $post->status == 2 ? 'selected' : '' }} >Protected</option>
						</select>
					</div>
				
					
				
					<button type="submit" class="btn btn-success">Update</button>
				</form>
			</div>
		</div>
	</div>
@endsection