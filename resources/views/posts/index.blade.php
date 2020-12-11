@extends('layout.admin')

@section ('content')
  <div class="container ">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h2>Posts</h2>
					</div>
					<div class="row">
						<div class="col-md-4">
						    <a href="{{route('posts.create')}}" class="btn btn-primary">Create</a>
						
					    </div>

					    <div class="col-md-8">
							<form action="" method="GET" class="form-inline" role="form">
							
								<div class="form-group">
									<label class="sr-only" for="">label</label>
									<input name="keyword" type="text" value="{{ request()->input('keyword') }}" class="form-control" id="" placeholder="keyword">
								</div>
							    
							    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
							</form>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-bordered">

							<thead>
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Categories</th>
									<th>Tag</th>
									<th>Status</th>
									<th>Created_at</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($posts as $post)
									<tr>
										<td>{{ $post->id }}</td>
										<td>{{ $post->title }}</td>
										<td>
											@if ($post->category)
											    {{ $post->category->name}}
											@endif
										</td>
										<td>
											@if ($post->tags->count())
												@foreach ($post->tags as $tag)
												    <p>{{ $tag->name }} - {{ $tag->pivot->created_at }}</p>
												@endforeach
											@endif
										</td>
										<td>
										@if ( $post->status == 1)
											<button class="btn btn-danger btn-off" data-id = " {{ $post->id }} ">Tắt</button>
										@else
											<button class="btn btn-success btn-on"> Bật </button>
										@endif
										</td>	
										<td>{{ $post->created_at }}</td>
										<td>
											<a href="{{ route('posts.edit', $post->id )}}" class="btn btn-primary"> Edit</a>


											<form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
												@csrf
												@method('delete')
											    <button  class="btn btn-danger" type="submit"> Delete </button> 
											</form>
										</td>
									</tr>
								@endforeach 
								
							</tbody>
					    </table>
					</div>

			    <footer>
			    	<ul class="pagination pagination-sm m-0 float-right">
			    	<!-- phân trang -->
				    	{{$posts->appends($_GET)}} 
					  </ul>
			    </footer>
				   
				</div>
				
			</div>
		</div>
	</div>

@endsection

@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
			$(".btn-off").click(function() {
				let id = $(this).data('id');
				//console.log(id);
				$.$.ajax({
					url: '/post/' . id . '/status',
					type: 'PUT',
					dataType: 'JSON',
					data: {status : 0},
				})
				.done(function(result) {
					console.log(result);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		});
	</script>
@endpush