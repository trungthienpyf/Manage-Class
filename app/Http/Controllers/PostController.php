<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        View()->share('title', 'Thông báo');
        return view('admin.index', [
            'posts' => Post::query()->latest()->paginate(),
        ]);

    }
    public function indexStudent(Request $request)
    {
        View()->share('title', 'Thông báo');
        return view('student.notify', [
            'posts' => Post::query()->whereNotIn('level',[2])->latest()->paginate(),
        ]);

    }
    public function indexTeacher(Request $request)
    {
        View()->share('title', 'Thông báo');
        return view('teacher.notify', [
            'posts' => Post::query()->whereNotIn('level',[3])->latest()->paginate(),
        ]);

    }
    public function store(StorePostRequest $request)
    {
         Post::create($request->all());
        return redirect()->route('admin', ['success' => 'Thêm bài viết thành công']);

    }
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin');
    }
}
