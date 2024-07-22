<?php

namespace SLIM\Abbreviation\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SLIM\Abbreviation\Database\factories\AbbreviationFactory;

class Abbreviation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['char_abbreviations', 'word_abbreviations', 'description_abbreviations', 'is_active'];


    protected static function newFactory(): AbbreviationFactory
    {
        //return AbbreviationFactory::new();
    }
}
