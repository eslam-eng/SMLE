<?php


namespace SLIM\Trainee\Repository;


use Illuminate\Database\Eloquent\Builder;
use SLIM\Trainee\interfaces\TraineeRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;
use SLIM\Trainee\App\Models\Trainee;

class TraineeRepository extends BaseRepository implements TraineeRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return  Trainee::class;
    }

    protected function applyFilters(array $searchParams = []): Builder
    {
        return $this
            ->getQuery()
            ->when(isset($searchParams['full_name']), function (Builder $query) use ($searchParams) {
                $query->where('full_name', 'like', "%{$searchParams['full_name']}%");
            })
            ->when(isset($searchParams['phone']), function (Builder $query) use ($searchParams) {
                $query->where('phone','LIKe','%'. $searchParams['phone'].'%');
            })
            ->when(isset($searchParams['email']), function (Builder $query) use ($searchParams) {
                $query->where('email','LIKE','%' .$searchParams['email'].'%');
            })
            ->when(isset($searchParams['is_active']), function (Builder $query) use ($searchParams) {
                $query->where('is_active', $searchParams['is_active']);
            })
            ->when(isset($searchParams['degree']), function (Builder $query) use ($searchParams) {
                $query->where('degree', $searchParams['degree']);
            })
            ->when(isset($searchParams['specialist_id']), function (Builder $query) use ($searchParams) {
                $query->wherehas('specialist',function ($q) use($searchParams){
                    $q->where('id',$searchParams['specialist_id']);
                });
            })
            ->when(isset($searchParams['sub_specialist_id']), function (Builder $query) use ($searchParams) {
                $query->wherehas('sub_specialist',function ($q) use($searchParams){
                    $q->where('id',$searchParams['sub_specialist_id']);
                });
            })
            ->when(isset($searchParams['packages']), function (Builder $query) use ($searchParams) {
                $query->has('packages');
            })
            ->when(isset($searchParams['trainee_id']), function (Builder $query) use ($searchParams) {
                $query->where('id',$searchParams['trainee_id']);

            })
            ->when(isset($searchParams['package_id']), function (Builder $query) use ($searchParams) {
                $query->whereHas('packages',function ($q)use($searchParams){
                    $q->where('trainee_subscribes.package_id',$searchParams['package_id']);
                });

            })
            ->when(isset($searchParams['payment']), function (Builder $query) use ($searchParams) {
                $query->whereHas('packages',function ($q)use($searchParams){
                    $q->where('trainee_subscribes.payment_method',$searchParams['payment']);
                });
            })
            ->when(isset($searchParams['is_paid']), function (Builder $query) use ($searchParams) {
                $query->whereHas('packages',function ($q)use($searchParams){
                    $q->where('trainee_subscribes.is_paid',$searchParams['is_paid']);
                });
            })
            ->when(isset($searchParams['package_type']), function (Builder $query) use ($searchParams) {
                $query->whereHas('packages',function ($q)use($searchParams){
                    $q->where('trainee_subscribes.package_type',$searchParams['package_type']);
                });
            })
            ->when(isset($searchParams['active']), function (Builder $query) use ($searchParams) {
                $query->whereHas('packages',function ($q)use($searchParams){
                    $q->where('trainee_subscribes.is_active',$searchParams['active']);
                });
            })
            ->orderBy('id','desc');
    }


}
