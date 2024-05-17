<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Interfaces\AuthorRepositoryInterface;
use App\Http\Resources\AuthorResource;
use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;

class AuthorController extends Controller
{
    private AuthorRepositoryInterface $authorRepositoryInterface;

    public function __construct(AuthorRepositoryInterface $authorRepositoryInterface)
    {
        $this->authorRepositoryInterface = $authorRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->authorRepositoryInterface->index();

        return ApiResponseClass::sendResponse(AuthorResource::collection($data),'',200);
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
    public function store(StoreAuthorRequest $request)
    {
        $details =[
            'name' => $request->name,
            'birth_date' => $request->birth_date
        ];
        DB::beginTransaction();
        try{
             $author = $this->authorRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new AuthorResource($author),'Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = $this->authorRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new AuthorResource($author),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name,
            'birth_date' => $request->birth_date
        ];
        DB::beginTransaction();
        try{
            $this->authorRepositoryInterface->update($updateDetails,$id);

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
         $this->authorRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Delete Successful','',204);
    }
}
