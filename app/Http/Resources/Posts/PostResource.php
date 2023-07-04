<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\FinancialInstitution\FinancialInstitutionResource;



class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['creator'] = new FinancialInstitutionResource($this->creator());

        $data['media_url'] = $this->getFirstMediaUrl('medias');

        $data['created_at_fmt'] = date('Y-m-d H:i',strtotime($data['created_at']));

        return $data;

    }
}
