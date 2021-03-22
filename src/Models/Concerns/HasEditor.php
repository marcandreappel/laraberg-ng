<?php
declare(strict_types=1);

namespace MarcAndreAppel\LarabergNG\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use MarcAndreAppel\LarabergNG\Models\Content;

trait HasEditor
{

    protected static function bootHasEditor(): void
    {
        // Persisting Laraberg editor contents only when the current model has been updated
        self::saved(function ($model) {
            if ($content = $model->editorContent) {
                $content
                    ->model()
                    ->associate($model)
                    ->save();
            }
        });

        // Permanently deleting Laraberg editor content when this model has been deleted
        self::deleted(function ($model) {
            $model->editorContent()->delete();
        });
    }

    public function editorContent(): MorphOne
    {
        return $this->morphOne(Content::class, 'model');
    }

    public function getEditorContentAttribute(): string
    {
        return $this->editorContent ? $this->editorContent->render() : '';
    }

    public function setEditorContentAttribute($content): void
    {
        if (! $this->editorContent) {
            $this->setRelation('editorContent', new Content);
        }

        $this->editorContent->setContent($content);
    }

    public function getEditorRawContentAttribute(): string
    {
        if (! $this->editorContent) {
            return '';
        };

        return $this->editorContent->raw_content;
    }
}
