<?php

namespace App\Services\Tax;

use App\Services\BaseService;
use App\Services\Interfaces\Tax\TaxServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\Tax\TaxRepositoryInterface as TaxRepository;

class TaxService extends BaseService implements TaxServiceInterface
{
    protected $taxRepository;
    protected $payload = ['name', 'code', 'description', 'value'];
    protected $fieldSearch = ['name', 'code', 'value'];

    public function __construct
    (
       TaxRepository $taxRepository
    )
    {
        $this->taxRepository = $taxRepository;
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

        $tax = $this->taxRepository->pagination($perpage, $condition, $this->fieldSearch, $relation, $extend);
        return $tax;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            $this->taxRepository->create($payload);
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
            $this->taxRepository->forceDeleteAll($ids);
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
            $this->taxRepository->update($payload, $id);

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
            $this->taxRepository->deleteId($id);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

}
