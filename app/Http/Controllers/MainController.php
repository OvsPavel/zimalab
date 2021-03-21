<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main', [
            'urls' => Url::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUrl(Request $request, Url $url)
    {
        $hash = Crypt::encrypt($request->url);
        $short_link = 'http://'.config('app.url').'/%'.substr(str_shuffle($hash), 0, 4).'%';

        $url = new Url;
        $url->hash = $hash;
        $url->short_link = $short_link;        
        $url->link = str_replace(['https://', 'http://'], '', $request->url);
        $url->save();
        return back();
    }

    public function viewsCount(Request $request, $id)
    {

        $url = Url::findOrFail($id);
        $url->views++;
        $url->save();
        if($url->views <= 5){
            return redirect('//'.$url->link);
        }else{
            return abort(404);
        }
    }

    
}
