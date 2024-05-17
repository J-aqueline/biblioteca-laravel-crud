<?php

namespace App\Repositories;
use App\Models\Loan;
use App\Interfaces\LoanRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LoanRepository implements LoanRepositoryInterface
{
    public function index() {
      return DB::table('loans')
            ->rightJoin('books', 'books.id', '=', 'loans.book_id')
            ->rightJoin('users', 'users.id', '=', 'loans.user_id')
            ->get();
    }

    public function getById($id) {
      return Loan::findOrFail($id);
    }

    public function store(array $data) {
      return Loan::create($data);
    }

    public function update(array $data,$id) {
      return Loan::whereId($id)->update($data);
    }
    
    public function delete($id) {
      Loan::destroy($id);
    }
}
