<?php

namespace Orian\Framework\Traits\Dependency;

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

    public function checkInUse($op)
    {
        $errors = [];
        $rows = $op['rows'] ?? [];
        $search = $op['search'] ?? [];
        $targetModel = $op['targetModel'] ?? [];
        $targetCol = $op['targetCol'] ?? [];
        $denied = $op['denied'] ?? [];
        $exists = $op['exists'] ?? [];
        $in = $op['in'] ?? [];
        foreach ($targetModel as $key => $model) {
            $ids = $rows?->pluck($search[$key])?->toArray() ?? [];
            $targetIds = $model->whereIn($targetCol[$key], $ids)->select([$targetCol[$key]])->pluck($targetCol[$key])->toArray();
            if (count($rows) > 0) {
                foreach ($rows as $row_keys => $value) {
                    if (in_array($value[$search[$key]], $targetIds)) {
                        $errors[] = trans('alerts.bigError', ['exists' => $exists[$key], 'denied' => $denied[$key], 'in' => $in[$key]]);
                        break;
                    }
                }
            }
        }
        return $errors;
    }
}
