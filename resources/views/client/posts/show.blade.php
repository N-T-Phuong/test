@extends ('client.layout.master')

@push('css')
<style type="text/css">
	
</style>
@endpush
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>{{ $post->title }}</h1>
                <div class="content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </div>


@endsection