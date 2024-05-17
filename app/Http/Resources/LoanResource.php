<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'book_id' => $this->book_id,
            'user_id' => $this->user_id,
            'return_date' => $this->return_date,
            'loan_date' => $this->loan_date,
            'book' => [
                'id' => $this->book_id,
                'title' => $this->title,
                'published_at' => $this->published_at,
            ],
            'user' => [
                'id' => $this->user_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'email_verified_at' => $this->email_verified_at,
                'password' => $this->password,
                'remember_token' => $this->remember_token,
            ],
        ];
    }
}