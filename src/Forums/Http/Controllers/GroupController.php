<?php

namespace AndrykVP\Rancor\Forums\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AndrykVP\Rancor\Forums\Group;
use AndrykVP\Rancor\Forums\Http\Resources\GroupResource;
use AndrykVP\Rancor\Forums\Http\Requests\GroupForm;

class GroupController extends Controller
{
    /**
     * Construct Controller
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware(config('rancor.middleware'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();

        return GroupResource::collection($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AndrykVP\Rancor\Forums\Http\Requests\GroupForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupForm $request)
    {
        $this->authorize('create',Group::class);
        
        $data = $request->all();
        $group = Group::create($data);

        return response()->json([
            'message' => 'Group "'.$group->title.'" has been created'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AndrykVP\Rancor\Forums\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $this->authorize('view',$group);

        return new GroupResource($group->load('users','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AndrykVP\Rancor\Forums\Http\Requests\GroupForm  $request
     * @param  \AndrykVP\Rancor\Forums\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupForm $request, Group $group)
    {
        $this->authorize('update',$group);
        
        $data = $request->all();
        $group->update($data);

        return response()->json([
            'message' => 'Group "'.$group->title.'" has been updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AndrykVP\Rancor\Forums\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete',$group);
        
        $group->delete();

        return response()->json([
            'message' => 'Group "'.$group->title.'" has been deleted'
        ], 200);        
    }
}