<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FullCalendarResource.
 * @package App\Http\Resources
 * @mixin Transaction
 */
class FullCalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start' => $this->date,
            'title' => $this->name,
            'amount' => $this->amount,
            'status' => $this->status,
            'type' => $this->type,
            'observations' => $this->observations,
            'company' => $this->company,
            'bankAccount' => $this->account,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'category' => $this->category,
            'textColor' => '#ffffff',
            'borderColor' => '#ffffff',
            'form' => [
                'id' => $this->id,
                'date' => $this->date,
                'name' => $this->name,
                'amount' => $this->amount,
                'status' => $this->status,
                'type' => $this->type,
                'observations' => $this->observations,
                'company_id' => $this->company_id,
                'account_id' => $this->account_id,
                'category_id' => $this->category_id,
            ],
        ];
    }
}
