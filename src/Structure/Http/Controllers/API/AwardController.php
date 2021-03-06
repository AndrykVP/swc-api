<?php

namespace AndrykVP\Rancor\Structure\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AndrykVP\Rancor\Structure\Models\Award;
use AndrykVP\Rancor\Structure\Http\Resources\AwardResource;
use AndrykVP\Rancor\Structure\Http\Requests\AwardForm;

class AwardController extends Controller
{
    /**
     * Construct Controller
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware(config('rancor.middleware.api'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Award::with('type')->paginate(config('rancor.pagination'));

        return AwardResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AndrykVP\Rancor\Structure\Http\Requests\AwardForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardForm $request)
    {
        $this->authorize('create',Award::class);
        
        $data = $request->validated();
        $award = Award::create($data);

        return response()->json([
            'message' => 'Award "'.$award->name.'" has been created'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AndrykVP\Rancor\Structure\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        $this->authorize('view', $award);
        $award->load('type','users');

        return new AwardResource($award);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AndrykVP\Rancor\Structure\Http\Requests\AwardForm  $request
     * @param  \AndrykVP\Rancor\Structure\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(AwardForm $request, Award $award)
    {
        $this->authorize('update', $award);
        
        $data = $request->validated();
        $award->update($data);

        return response()->json([
            'message' => 'Award "'.$award->name.'" has been updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AndrykVP\Rancor\Structure\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        $this->authorize('delete', $award);
        $award->delete();

        return response()->json([
            'message' => 'Award "'.$award->name.'" has been deleted'
        ], 200);        
    }

    /**
     * Display the results that match the search query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('viewAny',Award::class);
        
        $awards = Award::where('name','like','%'.$request->search.'%')->paginate(config('rancor.pagination'));

        return AwardResource::collection($awards);
    }
}