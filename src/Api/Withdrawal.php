<?php

namespace Paguesafe\Fitbank\Api;

use Paguesafe\Fitbank\Models\AtmAvailability;
use Paguesafe\Fitbank\Models\AtmInfo;
use Paguesafe\Fitbank\Models\DigitalWithdrawal;
use Paguesafe\Fitbank\Models\DigitalWithdrawalAuthorization;
use Paguesafe\Fitbank\Models\DigitalWithdrawalCancellation;
use Paguesafe\Fitbank\Models\DigitalWithdrawalQrCode;
use Paguesafe\Fitbank\Models\DigitalWithdrawalStatus;
use Paguesafe\Fitbank\Route;

class Withdrawal extends Api
{

    /**
     * GetBankTerminalInfosList
     * 
     * @param AtmAvailability $atmAvailability
     * @return mixed
     */
    public function getBankTerminalInfosList(AtmAvailability $atmAvailability)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'GetBankTerminalInfosList',
        ], $atmAvailability->toArray())));
    }

    /**
     * GetBankTerminalInfos
     * 
     * @param AtmInfo $atm
     * @return mixed
     */
    public function getBankTerminalInfos(AtmInfo $atm)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'GetBankTerminalInfos',
        ], $atm->toArray())));
    }

    /**
     * GenerateDigitalWithdrawal
     * 
     * @param MoneyTransferOut $transfer
     * @return mixed
     */
    public function generateDigitalWithdrawal(DigitalWithdrawal $withdrawal)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'GenerateDigitalWithdrawal',
        ], $withdrawal->toArray())));
    }


    /**
     * GetInfosByTokenDigitalWithdrawal
     * 
     * @param DigitalWithdrawalQrCode $code
     * @return mixed
     */
    public function getInfosByTokenDigitalWithdrawal(DigitalWithdrawalQrCode $code)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'GetInfosByTokenDigitalWithdrawal',
        ], $code->toArray())));
    }

    /**
     * AuthorizeDigitalWithdrawal
     * 
     * @param DigitalWithdrawalAuthorization $authorization
     * @return mixed
     */
    public function authorizeDigitalWithdrawal(DigitalWithdrawalAuthorization $authorization)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'AuthorizeDigitalWithdrawal',
        ], $authorization->toArray())));
    }

    /**
     * CancelDigitalWithdrawal
     * 
     * @param DigitalWithdrawalCancellation $cancellation
     * @return mixed
     */
    public function cancelDigitalWithdrawal(DigitalWithdrawalCancellation $cancellation)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'CancelDigitalWithdrawal',
        ], $cancellation->toArray())));
    }

    /**
     * GetDigitalWithdrawal
     * 
     * @param DigitalWithdrawalStatus $status
     * @return mixed
     */
    public function getDigitalWithdrawal(DigitalWithdrawalStatus $status)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'GetDigitalWithdrawal',
        ], $status->toArray())));
    }
}
