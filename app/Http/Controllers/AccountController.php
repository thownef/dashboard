<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AccountController extends Controller
{
    protected $roleOptions = [
        [
            "value" => "1",
            "label"=> "Company"
        ],
        [
            "value" => "2",
            "label"=> "Consultant"
        ],
        [
            "value" => "3",
            "label"=> "Expert"
        ],
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleOptions = $this->roleOptions;
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['full_name', 'email', 'role_id'])
            ->allowedSorts([
                'full_name',
                "email",
                "role_id",
            ])
            ->defaultSort("-created_at")
            ->paginate(10);
        return view("admin.account.index", compact("users", "roleOptions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleOptions = $this->roleOptions;

        return view("admin.account.create", compact("roleOptions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request)
    {
        $validated = $request->validated();
        $user = new User;
        $user->create($validated);
        return redirect(route("account.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roleOptions = $this->roleOptions;

        return view("admin.account.edit", compact("user", "roleOptions"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
        
        $user->update($validated);
        return redirect(route("account.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->is_deleted = 1;
        $user->save();
    
        return redirect(route("account.index"));
    }
}
