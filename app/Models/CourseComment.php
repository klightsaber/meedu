<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;

use App\User;
use Emojione\Emojione;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseComment extends Model
{
    use SoftDeletes, Scope;

    protected $table = 'course_comments';

    protected $fillable = [
        'user_id', 'course_id', 'content',
    ];

    public function setContentAttribute($content)
    {
        $this->attributes['content'] = Emojione::getClient()->shortnameToUnicode($content);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getContent()
    {
        return markdown_to_html($this->content);
    }
}
