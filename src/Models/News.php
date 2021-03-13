<?php


namespace App\Models\Adfm;


use App\Models\Adfm\File;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Adfm\Traits\AttachmentTrait;
use App\Models\Adfm\ILinkMenu;
use App\Models\Adfm\Traits\MenuLinkable;
use App\Models\Adfm\Traits\Sluggable;

/**
 * Wtolk\Adfm\Models\Page
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $content
 * @property array|null $options
 * @property array|null $meta
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Wtolk\Adfm\Models\File|null $image
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Query\Builder|News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|News withoutTrashed()
 * @mixin \Eloquent
 */
class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use AttachmentTrait;

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    protected $appends = ['url'];
    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at'
    ];

    public function image()
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('model_relation', '=', 'image');
    }

    public function getUrlAttribute()
    {
        return '/news/'.$this->published_at->format('Y/m/d/').$this->slug;
    }

    public function setPublishedAtAttribute($value)
    {
        if ($value == null) {
            $this->attributes['published_at'] = Carbon::now();
        } else {
            $this->attributes['published_at'] = $value;
        }
    }

}
