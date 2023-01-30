<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {

        $record = Post::find($data['id']);

        $metas = $record->meta->pluck('value', 'option');

        foreach($metas as $key=>$value) {
            $data['meta'][$key] = $value;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $meta = $data['meta'] ?? [];

        $strucutedMeta = [];

        foreach ($meta as $key => $value) {
            $strucutedMeta[] = [
                'option' => $key,
                'value' => $value
            ];
        }
        $data['meta'] = $strucutedMeta;
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        foreach($data['meta'] as $meta) {
            $record->meta()->where('option', $meta['option'])->updateOrCreate(
                ['option' => $meta['option']],
                ['value' => $meta['value']]
            );
        }
        return $record;
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
