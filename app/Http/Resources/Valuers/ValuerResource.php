<?php

namespace App\Http\Resources\Valuers;

use Illuminate\Http\Resources\Json\JsonResource;

class ValuerResource extends JsonResource
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
        $data['full_name'] = $data['first_name']." ".$data['last_name'];
        $data['email']  = $this->user_account->email;

        return $data;
    }
}
