<?php

namespace App\Services\Product;

use App\Services\BaseService;
use App\Services\Interfaces\Product\ProductCatalogueServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\Product\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;

class ProductCatalogueService extends BaseService implements ProductCatalogueServiceInterface
{
    protected $productCatalogueRepository;
    protected $payload = ['name', 'code', 'description'];
    protected $fieldSearch = ['name', 'code'];

    public function __construct
    (
        ProductCatalogueRepository $productCatalogueRepository
    )
    {
        $this->productCatalogueRepository = $productCatalogueRepository;
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

        $productCatalogue = $this->productCatalogueRepository->pagination($perpage, $condition, $this->fieldSearch, $relation, $extend);
        return $productCatalogue;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            $this->productCatalogueRepository->create($payload);
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
            $this->productCatalogueRepository->forceDeleteAll($ids);
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
            $this->productCatalogueRepository->update($payload, $id);

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
            $this->productCatalogueRepository->deleteId($id);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

}
