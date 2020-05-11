<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function all(): Collection;
}
