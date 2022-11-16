<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        // return parent::toArray($request);
        return [
                'id'=> $this->id,
                'mobile_title'=> $this->title,
                'description' => $this->description,
                // 'user_info'=>$this->user
                'user_info'=>new UserResource($this->user),
                'test'=>$this->when(true, 'hello condition attribute')
            ]; 
    }
}
