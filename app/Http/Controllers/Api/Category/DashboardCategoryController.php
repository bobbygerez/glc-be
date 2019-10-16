<?php

namespace App\Http\Controllers\API\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Category\CategoryInterface;
use App\Model\Category;

class DashboardCategoryController extends Controller
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

        $this->authorize('index', Category::class);
        $request = app()->make('request');
        return response()->json([
            'categories' => $this->category->paginate(
                $this->category->whereLike('name', 'like', '%' . $request->filter . '%')
                ->with('allChildren')
                ->orderBy('created_at', 'desc')
                ->get()
            )
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

        $this->authorize('index', Category::class);
        $this->category->create($request->all());
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $this->authorize('index', Category::class);
        return response()->json([
            'category' => $this->category->where('id', $request->id)->with(['allChildren'])->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->authorize('index', Category::class);
        return response()->json([
            'category' => $this->category->where('id', $request->id)->with(['allChildren'])->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('index', Category::class);
        $this->category->find($request->id)->update($request->all());
        return response([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $this->authorize('index', Category::class);
        $this->category->find($request->id)->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function categoriesAll(){
        return response()->json([
            'categories' => $this->category->categoriesAll()
        ]);
    }
}
