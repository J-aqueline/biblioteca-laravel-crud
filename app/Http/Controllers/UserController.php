<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->userRepositoryInterface->index();
        return ApiResponseClass::sendResponse(UserResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $details = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        DB::beginTransaction();

        try{
            $user = $this->userRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user),'Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = $this->userRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new UserResource($book),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $updateDetails =[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        DB::beginTransaction();
        try{
            $this->userRepositoryInterface->update($updateDetails,$id);

            DB::commit();
            return ApiResponseClass::sendResponse('Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->userRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Delete Successful','',204);
    }
}
