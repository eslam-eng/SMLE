<?php

namespace SLIM\Abbreviation\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Abbreviation\App\resources\AbbreviationResource;
use SLIM\Abbreviation\Interfaces\AbbreviationServiceInterface;
use SLIM\Traits\GeneralTrait;

class AbbreviationController extends Controller
{
        use GeneralTrait;
        private AbbreviationServiceInterface $abbreviationService;
    public function __construct(AbbreviationServiceInterface $abbreviationService)
    {
        $this->abbreviationService = $abbreviationService;
    }

    public function index(Request $request)
    {
        $request = $request->all();
        $request['is_active'] = 1;
        $abbreviations = $this->abbreviationService->getAllPaginated($request, 10);
        return $this->returnDateWithPaginate($abbreviations,AbbreviationResource::Class,'Abbreviation List');
    }
}
