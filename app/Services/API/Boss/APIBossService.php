<?php

namespace App\Services\API\Boss;

use App\Models\Boss\Boss;

class APIBossService
{
    /**
     * Get boss.
     *
     * @param int $bossId
     *
     * @return \App\Models\Boss\Boss
     */
    public function getBoss(int $bossId): Boss
    {
        return Boss::find($bossId);
    }
}
