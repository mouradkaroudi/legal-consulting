<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $record = $this->getModel()::create($data);

        foreach($data['meta'] as $meta) {
            $record->meta()->create($meta);
        }

        return $record;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
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

    public function mount(): void
    {
        $this->form->fill([
            'post_type' => request()->input('post_type'),
            'metadata' => [
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }
}
