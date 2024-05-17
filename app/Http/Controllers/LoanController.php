<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Models\Loan;
use App\Interfaces\LoanRepositoryInterface;
use App\Http\Resources\LoanResource;
use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;

class LoanController extends Controller
{
    private LoanRepositoryInterface $loanRepositoryInterface;

    public function __construct(LoanRepositoryInterface $loanRepositoryInterface)
    {
        $this->loanRepositoryInterface = $loanRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->loanRepositoryInterface->index();

        return ApiResponseClass::sendResponse(LoanResource::collection($data),'',200);
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
    public function store(StoreLoanRequest $request)
    {
        $details =[
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
        ];
        DB::beginTransaction();
        try{
            $loan = $this->loanRepositoryInterface->store($details);
            
            DB::commit();
            return ApiResponseClass::sendResponse(new LoanResource($loan),'Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loan = $this->loanRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new LoanResource($loan),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, $id)
    {
        $updateDetails =[
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
        ];

        DB::beginTransaction();
        try{
            $this->loanRepositoryInterface->update($updateDetails,$id);

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
         $this->loanRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Delete Successful','',204);
    }
}
