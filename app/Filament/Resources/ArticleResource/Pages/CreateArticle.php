<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Models\Variant;
use App\Models\TypeVariant;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ArticleResource;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected static ?string $title = 'Ajouter un article';
    public $variants;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // create article and variants

    protected function mutateFormDataBeforeCreate(array $data) : array
    {
        unset($data['Couleur']);
        unset($data['Taille']);
        unset($data['Capacité']);
        unset($data['Matière']);
        return $data;
    }



    public function afterCreate()
    {
        // get state
      //  unset($this->data['variants']);
        $data = $this->data;
        $lastCreated = \App\Models\Article::latest()->first();
        $lastCreated->stock()->create([
            'identifier' => "STOCK-".rand(1000, 9999), // "STOCK-1234
            'quantity_stoked' => $data['quantity'],
            'article_id' => $lastCreated->id
        ]);

        // create variants

        if($data['Couleur'] != null){
            foreach($data['Couleur'] as $color){
                Variant::create([
                    'value' => $color,
                    'article_id' => $lastCreated->id,
                    'type_variant_id' => TypeVariant::whereType('Couleur')->first()->id
                ]);
            }
        }

        if($data['Taille'] != null){
            foreach($data['Taille'] as $size){
                Variant::create([
                    'value' => $size,
                    'article_id' => $lastCreated->id,
                    'type_variant_id' => TypeVariant::whereType('Taille')->first()->id
                ]);
            }
        }

        if($data['Capacité'] != null){
            foreach($data['Capacité'] as $capacity){
                Variant::create([
                    'value' => $capacity,
                    'article_id' => $lastCreated->id,
                    'type_variant_id' => TypeVariant::whereType('Capacité')->first()->id
                ]);
            }
        }

        if($data['Matière'] != null){
            foreach($data['Matière'] as $material){
                Variant::create([
                    'value' => $material,
                    'article_id' => $lastCreated->id,
                    'type_variant_id' => TypeVariant::whereType('Matière')->first()->id
                ]);
            }
        }
    }



}
