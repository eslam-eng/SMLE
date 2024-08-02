<?php

namespace SLIM\Package\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SLIM\Package\App\Models\Package;
use SLIM\Package\App\resources\PackageResource;
use SLIM\Package\interfaces\PackageServiceInterface;
use SLIM\Traits\GeneralTrait;

class PackageController extends Controller
{
    use GeneralTrait;

    private PackageServiceInterface $packageService;

    public function __construct(PackageServiceInterface $packageService)
    {
        $this->packageService = $packageService;
    }

    public function index()
    {
        $packages = Package::query()
            ->where('is_active', 1)
            ->with(['activeSubscribe' => fn($query) => $query->where('trainee_id', auth()->id())])
            ->get();
        $packages = PackageResource::collection($packages);
        return $this->returnData($packages, 'Packages List');
    }
}
