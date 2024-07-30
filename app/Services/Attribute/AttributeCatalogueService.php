<?php

namespace App\Services\Attribute;

use App\Services\BaseService;
use App\Services\Interfaces\Attribute\AttributeCatalogueServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\Attribute\AttributeCatalogueRepositoryInterface as AttributeCatalogueRepository;

class AttributeCatalogueService extends BaseService implements AttributeCatalogueServiceInterface
{
    protected $attributeCatalogueRepository;
    protected $payload = ['name', 'code', 'description'];
    protected $fieldSearch = ['name', 'code'];

    public function __construct
    (
        AttributeCatalogueRepository $attributeCatalogueRepository
    )
    {
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
    }

    public function paginate($request)
    {
        $perpage = ($request->input('perpage')) ? $request->input('perpage') : 20;
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->input('publish'),
        ];
        $relation = [''];
        $extend = [
            'orderBy' => ['id', 'desc']
        ];

        $attributeCatalogue = $this->attributeCatalogueRepository->pagination($perpage, $condition, $this->fieldSearch, $relation, $extend);
        return $attributeCatalogue;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            // Case with attribute
            $payload['attribute_catalogue_id'] = $request->input('attributeCatalogueId');
            unset($payload['attributeCatalogueId']);

            $this->attributeCatalogueRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function deleteAll($request)
    {
        DB::beginTransaction();
        try {
            $ids = explode(',', $request->input('ids'));
            $this->attributeCatalogueRepository->forceDeleteAll($ids);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'description');
            $this->attributeCatalogueRepository->update($payload, $id);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->attributeCatalogueRepository->deleteId($id);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

}
