<?php


namespace App\Services;


use App\User;
use MCS\MWSClient;

class AmazonClient
{
    protected $mws;

    /**
     * AmazonClient constructor.
     * @param $user
     * @param int $marketplaceId
     * @throws \Exception
     */
    public function __construct (User $user, int $marketplaceId)
    {

        $marketplace = $user->marketplaces()->findOrFail($marketplaceId);
        dump($marketplace);
        $this->mws = new MWSClient(
            [
                'Marketplace_Id' => $marketplace->amazon_marketplace_id,
                'Seller_Id' => $marketplace->pivot->seller_id,
                'Access_Key_ID' => config('mws.' . $marketplace->region->name . '.access_id'),
                'Secret_Access_Key' => config('mws.' . $marketplace->region->name . '.secret_key'),
                'MWSAuthToken' => $marketplace->pivot->mws_auth_token,
            ]
        );

    }

    /**
     * @param $reportType
     * @param null $startDate
     * @param null $endDate
     * @return string
     * @throws \Exception
     */
    public function requestReport ($reportType, $startDate = null, $endDate = null)
    {
        dump('I am here');

        if (!$startDate) {
            $startDate = now()->subDays(2)->toDateTime();
        }

        if (!$startDate) {
            $endDate = now();
        }

        if ($this->mws) {
            return $this->mws->RequestReport(
                $reportType,
                $startDate,
                $endDate
            );
        }
    }

    public function getReportRequestList ($reportType = [])
    {
        return $this->mws->GetReportList($reportType);
    }

    public function getReport ($reportId)
    {
        return $this->mws->GetReport($reportId);
    }

    public function ListInventorySupply(array $skus)
    {
        return $this->mws->ListInventorySupply($skus);
    }
}
