<?php

namespace Alikhedmati\SMS\Contracts;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

interface HasStatistics
{
    /**
     * @param Carbon $started_at
     * @param Carbon $ended_at
     * @param int $rows
     * @param int $pages
     * @return Collection
     */

    public function getLog(Carbon $started_at, Carbon $ended_at, int $rows, int $pages): Collection;

    /**
     * @return string
     */

    public function getCredit(): string;
}