<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Repo\Category\CategoryInterface;

class CategoryController extends Controller
{

    protected $category;
    public function __construct(CategoryInterface $category){

        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response()->json([
            'categories' => Category::where('parent_id', 0)
                                ->with('allChildren')
                                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){

        return response()->json([
            'categories' => $this->category
                            ->whereNoObfuscate('name', 'LIKE', '%'. $request->search . '%')
                            ->when($request->search === null, function($q){
                                return $q->where('parent_id', 0);
                            })
                            ->with('allChildren')
                            ->get()
        ]);
    }

    public function mainCategories(){

        return response()->json([
            'mainCategories' => $this->category->mainCategories()->get()
        ]);
    }

    public function subCategories(Request $request){

        return response()->json([
            'subCategories' => $this->category->subCategories($request->id)->get()
        ]);

    }

    public function moreCategories(Request $request){
        return response()->json([
            'moreCategories' => $this->category->moreCategories($request->id)->get()
        ]);
    }
}
