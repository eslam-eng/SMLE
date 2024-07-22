<?php

namespace SLIM\Abbreviation\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbbreviationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' =>$this->id,
          'char_abbreviations'=>$this->char_abbreviations,
          'word_abbreviations'=>$this->word_abbreviations,
          'description_abbreviations'=>$this->description_abbreviations,
        ];
    }
}
