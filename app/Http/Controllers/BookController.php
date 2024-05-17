<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Interfaces\BookRepositoryInterface;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepositoryInterface;

    public function __construct(BookRepositoryInterface $bookRepositoryInterface)
    {
        $this->bookRepositoryInterface = $bookRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->bookRepositoryInterface->index();
        return ApiResponseClass::sendResponse(BookResource::collection($data),'',200);
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
    public function store(StoreBookRequest $request)
    {
        $author_ids = $request->author_ids;
        $details = [
            'title' => $request->title,
            'published_at' => $request->published_at,
        ];

        DB::beginTransaction();

        try{
            $book = $this->bookRepositoryInterface->store($details);
            $book->authors()->attach($author_ids);

            DB::commit();
            return ApiResponseClass::sendResponse(new BookResource($book),'Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = $this->bookRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new BookResource($book),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $author_ids = $request->author_ids;
        $updateDetails =[
            'title' => $request->title,
            'published_at' => $request->published_at
        ];
        DB::beginTransaction();
        try{
            $book = $this->bookRepositoryInterface->update($updateDetails,$id);
            $book->authors()->attach($author_ids);

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
         $this->bookRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Delete Successful','',204);
    }
}
