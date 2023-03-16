<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $searchable = [
        'ans'
    ];

    public function question (): BelongsTo {
        return $this->belongsTo(Question::class);
    }

    public function scopeSearch(Builder $builder, $terms=""):void {

        foreach($this->searchable as $searchable) {

            $builder->when(str_contains($searchable, '.'),

            function ($query) use($terms, $searchable) {

                [$relation, $relation_attribute] = explode($searchable, ".");
                $query->orWhereRelation($relation, $relation_attribute, "Like", "%{$terms}%");
            });
            
            $builder->orWhere($searchable, 'Like', "%{$terms}%");
        }
    }
}
