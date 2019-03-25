<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class bookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $bookmarks=Bookmark::where('user_id', $user_id)->get();
        return view('bookmarks',compact('bookmarks')); /**bookmark view */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user_id=Auth::user()->id;
        $bookmarked = Bookmark::where('event_id',$id)
            ->where('user_id', $user_id)
            ->value('event_id');

        if($bookmarked != $id) {
            $bookmark = Bookmark::create([
                'user_id' => $user_id,
                'event_id' => $id,
            ]);
            $bookmark->save();
            return redirect()->back()->with('status', 'Event has been added to your bookmarks');
        }
        return redirect()->back()->with('error', 'Event already exists in your bookmarks');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bookmark::where('id' , $id)->delete();
       return redirect()->back()->with('status', 'Item has successfully been removed from your bookmarks');
    }
}
