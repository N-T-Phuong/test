@extends ('client.layout.master')

@push('css')
<style type="text/css">
	
</style>
@endpush
@section('content')

    <div class="jumbotron">
	   	<div class="container">
	   		<h1>{{ $category->name }}</h1>
	   		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, ipsum porro dolor, molestiae suscipit commodi aliquam quo voluptatem doloribus. Blanditiis veniam facilis, tempora quidem aliquid obcaecati molestias dolorum soluta tenetur?</p>
            <button class="btn btn-primary">PHP</button>

	   	</div>
    </div>

    <div class="container">
    	<div class="row">
    		<div class="col-md-6 col-md-offset-2">
    			@foreach ($category->posts as $post)
    			<div class="post">
    				<h1>{{ $post->title }}</h1>
    				<p>{{ substr(strip_tags($post->content), 0, 200) }} ...</p>
                    <p><a href="{{ route(' post.show', $post->id )}" class="btn btr-primary">Xem thêm</a></p>
    			</div>
    			@endforeach
    			
    		</div>
    	</div>
    </div>

@endsection