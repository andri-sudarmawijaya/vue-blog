<?php
namespace Bantenprov\VueBlog\Traits;

/**
 * Use this trait within an Eloquent model to establish appropriate User-Post
 * relationships.
 */
trait BlogUserTrait
{
    /**
     * A user can have many Posts
     *
     * @return mixed
     */
    public function posts()
    {
      return $this->hasMany('Bantenprov\VueBlog\Models\Blog');
    }
}
