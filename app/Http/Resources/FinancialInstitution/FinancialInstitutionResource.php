<?php

namespace App\Http\Resources\FinancialInstitution;

use Illuminate\Http\Resources\Json\JsonResource;

class FinancialInstitutionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data =  parent::toArray($request);
        $data['logo_url'] = $this->getFirstMediaUrl('logos');

        return $data;
    }
}
