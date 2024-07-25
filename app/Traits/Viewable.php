<?php

namespace App\Traits;

use App\Models\View;
use Illuminate\Support\Facades\Auth;


trait Viewable
{

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function incrementViews()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $view = View::firstOrCreate([
                'user_id' => $userId,
                'viewable_id' => $this->id,
                'viewable_type' => get_class($this),
            ]);

            if ($view->wasRecentlyCreated) {
                $this->increment('views');
            }
        }
    }
}
