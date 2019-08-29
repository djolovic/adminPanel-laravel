<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NewsFeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $newsFeed;

    public function __construct(NewsFeed $newsFeed)
    {
        $this->middleware('auth')->except(['index', 'show']);

        $this->newsFeed = $newsFeed;
    }

    public function index()
    {
        return view('news_feeds.index', ['newsFeeds'=>$this->newsFeed->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news_feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUser $adminUser, Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'text' => 'required',
            'link' => 'required'
        ]);

        NewsFeed::create([
            'title' => request('title'),
            'text' => request('text'),
            'link' => request('link'),
            'support_id' => Auth::user()->id
        ]);


        return redirect()->route('news_feeds.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NewsFeed $newsFeed)
    {
        return view('news_feeds.show', compact('newsFeed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsFeed $newsFeed)
    {

        return view('news_feeds.edit', compact('newsFeed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $newsFeed = $this->newsFeed->find($id);


        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'link' => 'required'
        ]);

        $input = $request->all();

        $newsFeed->fill($input)->save();




        return Redirect::to('admin/news_feeds');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsFeed=NewsFeed::find($id);
        $newsFeed->delete();
        
        return back();

    }

}
