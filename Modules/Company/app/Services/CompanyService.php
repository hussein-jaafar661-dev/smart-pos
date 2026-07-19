<?php

declare(strict_types=1);

namespace Modules\Company\app\Services;

use Modules\Company\Models\Company;

class CompanyService
{
    private const CODE_PREFIX = 'COMP';

    private const CODE_PADDING = 4;

    /**
     * Get the latest created company.
     */
    private function getLastCompany():?company{
        return company::query()->OrderByDesc('code')->first();// Get the latest created company
    }



    /**
     * Generate the next company code.
     */
    private function generateCode():string
    {
        $lastcompany = $this->getLastCompany();
        if ($lastcompany===null) {
            return self::CODE_PREFIX . str_pad('1', self::CODE_PADDING, '0', STR_PAD_LEFT);
        }
        $lastcode = $lastcompany->code;
        $lastnumber = (int) substr($lastcode, strlen(self::CODE_PREFIX));
        $nextnumber = $lastnumber + 1;
        return self::CODE_PREFIX . str_pad((string) $nextnumber, self::CODE_PADDING, '0', STR_PAD_LEFT);
    }
}