<?php

namespace App\Filament\Resources\CategoryResource\Widgets;

use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    public function getTablePage(): string
    {
        return ListCategories::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Category', Category::count())
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success')
        ];
    }
}
