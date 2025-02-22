<?php

declare(strict_types=1);

namespace App\Queries;

use App\User;
use Illuminate\Database\Eloquent\Collection;

final class RankedUsersQuery
{
    public function fetchAll(?string $country): Collection
    {
        $userQuery = User::query();

        if ($country) {
            $userQuery->where('country_code', $country);
        }

        return $userQuery
            ->withCount('elephpants as elephpants_unique')
            ->join('elephpant_user', 'users.id', '=', 'elephpant_user.user_id')
            ->selectRaw('users.*, SUM(elephpant_user.quantity) as elephpants_total')
            ->groupBy('users.id')
            ->orderBy('elephpants_unique', 'desc')
            ->orderBy('elephpants_total', 'desc')
            ->get();
    }
}
