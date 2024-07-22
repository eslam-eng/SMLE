<?php

namespace SLIM\Package\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Package\App\resources\PackageResource;
use SLIM\Package\interfaces\PackageServiceInterface;
use SLIM\Traits\GeneralTrait;

class PackageController extends Controller
{
    use GeneralTrait;

    private PackageServiceInterface $packageService;
    public function __construct(PackageServiceInterface $packageService)
    {
        $this->packageService  = $packageService;
    }

    public function index()
    {
        $packages =PackageResource::collection($this->packageService->getAll(['is_active' => 1]));
        return $this->returnDate($packages,'Packages List');
    }
}
