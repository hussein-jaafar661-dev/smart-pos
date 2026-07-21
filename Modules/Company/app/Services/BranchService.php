<?php

declare(strict_types=1);

namespace Modules\Company\Services;
use Modules\Company\Models\Branch;

class BranchService
{
    private const CODE_PREFIX = 'BR';
    private const CODE_PADDING = 4;
    /**
     * Get the latest created branch.
     */
    private function getLastBranch():?Branch
    {
      return Branch::query()->orderByDesc('code')->first();
        
    }

    /**
     * Generate the next branch code.
     */
    private function generateCode():string
    {
        $lastBranch = $this->getLastBranch();
        if ($lastBranch === null) {
            return self::CODE_PREFIX . str_pad('1', self::CODE_PADDING, '0', STR_PAD_LEFT);
        }
        $lastCode = $lastBranch->code;
        $lastNumber = (int) substr($lastCode, strlen(self::CODE_PREFIX));
        $nextNumber = $lastNumber + 1;
        return self::CODE_PREFIX . str_pad((string) $nextNumber, self::CODE_PADDING, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new branch.
     */
    public function create(array $branch): Branch
    {   $branchData=$branch;
        $branchData['code'] = $this->generateCode();
        $Branch=Branch::create($branchData);
        return $Branch;
    }

    /**
     * Create the main branch.
     */
    public function createMainBranch(array $branchData): Branch
    {
        $branchData['is_main'] = true;
        return $this->create($branchData);
    }
}