<?php

declare(strict_types=1);

namespace Modules\Company\Services;

use Modules\Company\Models\Company;
use Modules\Company\Models\CompanySetting;
use Illuminate\Support\Facades\DB;
class CompanyService
{
    private const CODE_PREFIX = 'COMP';

    private const CODE_PADDING = 4;

    /**
     * Get the latest created company.
     */
    private function getLastCompany():?Company{
        return Company::query()->OrderByDesc('code')->first();// Get the latest created company
    }



    /**
     * Generate the next company code.
     */
    private function generateCode():string
    {
        $lastCompany = $this->getLastCompany();
        if ($lastCompany === null) {
            return self::CODE_PREFIX . str_pad('1', self::CODE_PADDING, '0', STR_PAD_LEFT);
        }
        $lastCode = $lastCompany->code;
        $lastNumber = (int) substr($lastCode, strlen(self::CODE_PREFIX));
        $nextNumber = $lastNumber + 1;
        return self::CODE_PREFIX . str_pad((string) $nextNumber, self::CODE_PADDING, '0', STR_PAD_LEFT);
    }

    public function create(array $data): Company
{
    return DB::transaction(function () use ($data) {
    $companyData = $data['company'];
    $companyData['code']=$this->generateCode(); // 1. Generate company code.
   
    $company = Company::create($companyData);        // 2. Create company.
//$this->createMainBranch( $company,$data['branch']); // 3. Create main branch.
$branchService = new BranchService();// TODO: Replace with Dependency Injection.
$branchData = $data['branch'];

$branchData['company_id'] = $company->id;

$branchService->createMainBranch($branchData);
        $this->createBusinessSettings($company);
    return $company;
       
    });
}  
   

        

        // 3. Create business settings.
private function createBusinessSettings(
    Company $company
): CompanySetting
{
    return CompanySetting::create([
        'company_id' => $company->id,
    ]);
}
}      // 5. Return company.
