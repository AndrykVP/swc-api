<?php

namespace AndrykVP\Rancor\Structure\Http\Controllers;

use AndrykVP\Rancor\Structure\Department;
use AndrykVP\Rancor\Structure\Http\Requests\DepartmentForm;
use AndrykVP\Rancor\Structure\Faction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
     * Variable used in View rendering
     * 
     * @var array
     */
    protected $resource = [
        'name' => 'Department',
        'route' => 'departments'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Department::class);

        $resource = $this->resource;
        $models = Department::paginate(config('rancor.pagination'));

        return view('rancor::resources.index', compact('models','resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Department::class);

        $resource = $this->resource;
        $form = array_merge(['method' => 'POST',],$this->form());
        return view('rancor::resources.create', compact('resource','form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AndrykVP\Rancor\Structure\Http\Requests\DepartmentForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentForm $request)
    {
        $this->authorize('create', Department::class);

        $data = $request->validated();
        $department = Department::create($data);

        return redirect(route('admin.departments.index'))->with('alert','Department "'.$department->name.'" has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \AndrykVP\Rancor\Structure\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $this->authorize('view', $department);

        $department->load('faction','ranks','users');

        return view('rancor::show.department', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AndrykVP\Rancor\Structure\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $this->authorize('update', $department);

        $resource = $this->resource;
        $form = array_merge(['method' => 'PATCH',],$this->form());
        $model = $department;
        return view('rancor::resources.edit', compact('resource','form','model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AndrykVP\Rancor\Structure\Http\Requests\DepartmentForm  $request
     * @param  \AndrykVP\Rancor\Structure\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentForm $request, Department $department)
    {
        $this->authorize('update', $department);

        $data = $request->validated();
        $department->update($data);

        return redirect(route('admin.departments.index'))->with('alert','Department "'.$department->name.'" has been successfully updated.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \AndrykVP\Rancor\Structure\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);
        
        $department->delete();

        return redirect(route('admin.departments.index'))->with('alert','Department "'.$department->name.'" has been successfully deleted.');
    }

    /**
     * Variable for Form fields used in Create and Edit Views
     * 
     * @var array
     */
    protected function form()
    {
        return [
            'inputs' => [
                [
                    'name' => 'name',
                    'label' => 'Name',
                    'type' => 'text',
                    'attributes' => 'autofocus required'
                ],
                [
                    'name' => 'description',
                    'label' => 'Description',
                    'type' => 'text',
                    'attributes' => 'required'
                ],
            ],
            'selects' => [
                [
                    'name' => 'faction_id',
                    'label' => 'Faction',
                    'attributes' => 'required',
                    'multiple' => false,
                    'options' => Faction::orderBy('name')->get(),
                ],
            ]
        ];
    }
}