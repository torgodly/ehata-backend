<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();
        $data['user_id'] = auth()->user()->id;

        if ($data['is_featured']) {
            // Set now only if the record doesn't already have a featured_at
            $data['featured_at'] = $record?->featured_at ?? now();
        } else {
            // Clear featured_at if not featured
            $data['featured_at'] = null;
        }

        return $data;
    }
}
