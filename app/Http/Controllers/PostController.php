<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Validator;
use App\Models\Category;
use App\Models\Tag;
use Gate;

/**
 * 
 */
class PostController extends Controller
{
	
	public function index (Request $request)
	{
		if ( Gate::denies('posts.manage')) {
			abort(403);
		}


		$keyword = $request->input('keyword');
		$query = Post::query();
		if ( $keyword) {
			$query->where('title', 'like', "%{$keyword}%");
		}
		$query->orderBy('id', 'desc');
		$posts = $query->paginate(3);
		//để lấy tất cả posts ra thì phải gọi tới model post
		//$posts = Post::all();
		//$posts = Post::paginate(2);//phân trang
		return view('posts.index', compact('posts'));//cmpact: là hàm đổi về dạng ơ sâu ... array
	}

	public function create()
	{
		$categories = Category::all();
		$tags = Tag::all();

		return view('posts.create', compact('categories', 'tags'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
    		'title' => 'required',
    		'content' => 'required'
    	], [
    		'title.required' => 'tiêu đề là trường bắt buộc',
    		'content.required' => 'mô tả là trường bắt buộc'

    	]);

    	if ($validator->fails()) {
    		return back()->withErrors($validator)->withInput();
    	}
    	//dd($request->all());

    	$tagIds = $request->input('tags', []);
		$title = $request->input('title');
		$content = $request->input('content');
		$categoryId = $request->input('category_id');
		$status = $request->input('status');

		//dd($title);

		$post = new Post;
		$post->title = $title;
		$post->content = $content;
		$post->category_id = $categoryId;
		$post->status = $status;
		$post->save();
		// gán vào , thêm mới
		$post->tags()->attach($tagIds, ['created_at' => date( 'Y-m-d H:i:s' )]); // cập nhật ngày phải thêm trường thứ 2

		//$post->tags()->sync($tagIds); // đồng bộ  dùng cho update 

		//echo "Insert success";
		return redirect()->route('posts.index', $post->id);
	}

	public function edit($id)
	{
		//dd($id);
		$post = Post::find($id);
		if (!$post) {
			return (404);
		}

		$category = Category::all();
	    $tag = Tag::all();
		return view('posts.edit', compact('post', 'caterory', 'tag'));
	}
	
	public function update($id, Request $request)
	{
		$tagIds = $request->input('tags', []);
		$title = $request->input('title');
		$content = $request->input('content');
		$categoryId = $request->input('category_id');
		$status = $request->input('status');

		//dd($title);

		$post = Post::find($id);
		$post->title = $title;
		$post->content = $content;
		$post->category_id = $categoryId;
		$post->status = $status;
		$post->save();
		$post->tags()->sync($tagIds);

		//echo "update success";
		return redirect()->route('posts.edit', $post->id);
	}
	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		return redirect()->route('posts.index');
	}
	public function show($id)
	{
		$post = Post::find($id);
		return view('client.posts.show', compact('post'));
	}

	public function updateStatus(Request $request)
	{
		$post = Post::find($id);
		$status = $request->input('status',1);
		$post->status = $status;
		$post->save();
		//ajax
		return response()->json([
			'status' => $status
		]);
	}
}
 ?>