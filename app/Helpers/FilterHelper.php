<?php

namespace App\Helpers;

use App\Models\Material;
use App\Models\Color;

class FilterHelper
{
    public static function applyMaterialAndColorFilters($query, $materialIds, $colorIds) {
        if ($materialIds) {
            $query->whereIn('material_id', $materialIds);
        }
        if ($colorIds) {
            $query->whereIn('color_id', $colorIds);
        }

        return $query;
    }

    public static function getMaterialsAndColors() {
        return [
            'materials' => Material::orderBy('name', 'asc')->get(['id', 'name']),
            'colors' => Color::orderBy('name', 'asc')->get(['id', 'name']),
        ];
    }
}
