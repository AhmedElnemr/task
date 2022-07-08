<?php

namespace App\Http\Resources;

use App\Models\UserCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = [
            'id' => (int)$this->id ,
            'username' =>  $this->username  ,
            'phone_number' => $this->phone_number   ,
            'is_verified' => (boolean)$this->is_verified ,
            'created_at' => date("Y-m-d",strtotime($this->created_at)) ,

        ];
        return $user;
        //return parent::toArray($request);
    }
}
