<?php
declare(strict_types=1);

namespace MarcAndreAppel\LarabergNG\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use MarcAndreAppel\LarabergNG\Helpers\EmbedHelper;
use MarcAndreAppel\LarabergNG\Helpers\BlockHelper;
use MarcAndreAppel\LarabergNG\Events\ContentCreated;
use MarcAndreAppel\LarabergNG\Events\ContentUpdated;
use MarcAndreAppel\LarabergNG\Events\ContentRendered;

/**
 * @property string rendered_content
 */
class Content extends Model
{

    public string $raw_content;

    protected $table = 'editor_contents';

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new ContentCreated($model));
        });

        static::updated(function ($model) {
            event(new ContentUpdated($model));
        });
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function render(): string
    {
        $html = BlockHelper::renderBlocks($this->rendered_content);

        event(new ContentRendered($this));

        return "<div class='gutenberg__content wp-embed-responsive'>$html</div>";
    }

    public function setContent(string $html)
    {
        $this->raw_content = $this->fixEmptyImages($html);
        $this->renderRaw();
    }

    public function renderRaw(): string
    {
        $this->rendered_content = EmbedHelper::renderEmbeds($this->raw_content);

        event(new ContentRendered($this));

        return $this->rendered_content;
    }

    /**
     * @todo Remove this temporary fix for Image block crashing when no image is selected
     */
    private function fixEmptyImages(string $html): string
    {
        $regex = '/<img(.*)\/>/';
        return preg_replace_callback($regex, function ($matches) {
            if (isset($matches[1]) && !str_contains($matches[1], 'src="')) {
                return str_replace('<img ', '<img src="/vendor/laraberg/img/placeholder.jpg" ', $matches[0]);
            }
            return $matches[0];
        }, $html);
    }
}
