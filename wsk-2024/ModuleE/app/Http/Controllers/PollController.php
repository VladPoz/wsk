<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PollController extends Controller
{
    //
    public function welcome(){
        $polls = Poll::all();
        return view('welcome', compact('polls'));
    }
    public function show($slug)
    {
        $poll = Poll::query()->where('slug', $slug)->firstOrFail();
        $poll->load('category');
        $poll->load('questions');
        $answers = Answer::all();
        return view('poll', compact('poll', 'answers'));
    }
    public function submit($slug, Request $request){
        $poll = Poll::query()->where('slug', $slug)->firstOrFail();
//        dd($request->all());
        foreach($request->all() as $key => $value){
            if($key == '_token'){
                continue;
            }
            if (is_array($value)){
                foreach($value as $item){
                    $answerCount = Answer::query()->where('id', $item)->value('count');
                    Answer::query()->where('id', $item)->update(['count' => $answerCount+1]);
                }
            }else{
                $answerCount = Answer::query()->where('id', $value)->value('count');;
                Answer::query()->where('id', $value)->update(['count' => $answerCount+1]);
            }
        }
        return redirect()->route('welcome');
    }

    public function index(){
        $polls = Poll::all();
        return view('admin.poll.index', compact('polls'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.poll.create', compact('categories'));
    }
    public function store(PollRequest $request){
        $data = $request->validated();
        Poll::query()->create([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => Str::random(8),
        ]);
        return redirect()->route('admin.poll.index')->with('success', 'Poll create successfully');
    }
    public function edit($id){
        $poll = Poll::query()->findOrFail($id);
        $categories = Category::all();
        return view('admin.poll.edit', compact('poll', 'categories'));
    }
    public function update(PollRequest $request, $id){
        $data = $request->validated();
        $poll = Poll::query()->findOrFail($id);
        $poll->update([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
        return redirect()->route('admin.poll.index')->with('success', 'Poll update successfully');
    }
    public function destroy($id){
        $poll = Poll::query()->findOrFail($id);
        $poll->delete();
        return redirect()->route('admin.poll.index')->with('success', 'Poll deleted successfully');
    }
}
