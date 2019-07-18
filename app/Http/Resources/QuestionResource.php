<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
          'title' => $this->title, // kolom pada table database question
          'slug' => $this->slug,
          'path' => $this->path,
          'body' => $this->body,
          'replies' => ReplyResource::collection($this->replies),
          'replies_count' => $this->replies->count(),
          'created_at' => $this->created_at->diffForHumans(),
          'user' => $this->user->name, // ambil dari function user yang ada pada models questions yg telah direlasikan
          'user_id' => $this->user_id
        ];
        // kenapa name karena pada tabel questions telah direlasikan ke user jadi bisa didapatkan name user, ini untuk menghindari users tau id user tersebut ketka dikirim dengan API
    }
}
