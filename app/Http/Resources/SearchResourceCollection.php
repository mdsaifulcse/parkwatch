<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $path=explode('?',$this->nextPageUrl())[0];
        return [
            'parkingSpot' =>$this->collection,

            'pagination' => [
                'first_page_url' => $path.'?page=1',
                'last_page' => $this->lastPage(),
                'last_page_url' => $path."?page=".$this->lastPage(),
                'next_page_url' => $this->nextPageUrl(),
                'path' => $path,
                'per_page' => $this->perPage(),
                'prev_page_url' => $this->previousPageUrl(),
                'total' => $this->total(),
                'count' => $this->count(),
                'current_page' => $this->currentPage(),
            ],
        ];
    }
}
