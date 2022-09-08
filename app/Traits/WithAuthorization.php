<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait WithAuthorization
{
    public function mountWithAuthorization()
    {
        Gate::authorize('edit-employees-profile', $this->employee);
    }
}
