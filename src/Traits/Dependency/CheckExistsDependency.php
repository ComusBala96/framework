<?php

namespace Orian\Framework\Traits\Dependency;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait CheckExistsDependency
{
    public function checkExists($request, $data, $select = ['*'])
    {
        $values = explode('|', $data);
        $data = $values = explode('|', $data);
        $data = $this->{$values[0]}->getQuery([
            'type' => 'first',
            'query' => [
                'where' => [
                    [[
                        $values[1],
                        '=',
                        $request->{$values[2]}
                    ]]
                ]
            ],
            'select' => $select
        ]);
        return $data;
    }

    public function checkInUse(array $op): array
    {
        $errors = [];
        $rows = collect($op['rows'] ?? []);
        $search = $op['search'] ?? [];
        $targetModel = $op['targetModel'] ?? [];
        $targetCols = $op['targetCol'] ?? [];
        $denied = $op['denied'] ?? [];
        $exists = $op['exists'] ?? [];
        $in = $op['in'] ?? [];
        foreach ($targetModel as $key => $model) {
            $ids = $rows->pluck($search[$key])->filter()->unique()->values()->toArray();
            if (empty($ids)) {
                continue;
            }
            $targetIds = $this->getTargetIds($model, $targetCols[$key], $ids);
            if (array_intersect($ids, $targetIds)) {
                $errors[] = trans('alerts.bigError', ['exists' => $exists[$key] ?? '', 'denied' => $denied[$key] ?? '', 'in' => $in[$key] ?? '']);
            }
        }
        return $errors;
    }

    private function getTargetIds(object | string $model, string $column, array $ids): array
    {
        if ($model instanceof Model) {
            return $model::query()->whereIn($column, $ids)->pluck($column)->toArray();
        }
        return DB::table($model)->whereIn($column, $ids)->pluck($column)->toArray();
    }
}
