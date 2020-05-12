<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->approved_for_editing;
    }

    /**
     * @return bool
     */
    public function view()
    {
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->approved_for_editing;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->approved_for_editing;
    }


}
