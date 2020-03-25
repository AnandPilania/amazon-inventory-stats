<?php


namespace App\Services;


use MCS\MWSClient;

class AmazonClient
{
    protected $mws;

    public function __construct ($user, $marketplace)
    {
        try {

            if ($user) {
                $this->mws = new MWSClient(
                    [
                        'Marketplace_Id' => config('mws.US.marketplace_id'),
                        'Seller_Id' => $marketplace->seller_id,
                        'Access_Key_ID' => config('mws.US.access_id'),
                        'Secret_Access_Key' => config('mws.US.secret_key'),
                        'MWSAuthToken' => $marketplace->mws_auth_token,
                    ]
                );
            }
        } catch (\Exception $e) {
        }

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
        if ($this->mws) {

            return $this->mws->RequestReport($reportType, $startDate, $endDate);
        }

    }
}
