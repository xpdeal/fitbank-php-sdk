<?php

namespace Paguesafe\Fitbank\Api;

use Paguesafe\Fitbank\Route;
use Paguesafe\Fitbank\Models\Account as AccountModel;
use Paguesafe\Fitbank\Models\BankAccount;
use Paguesafe\Fitbank\Models\CloseAccount;
use Paguesafe\Fitbank\Models\NewAccount;
use Paguesafe\Fitbank\Models\Person;

class Account extends Api
{

    /**
     * GetAccountList
     * 
     * @param int $pageSize
     * @param int $index
     * @return mixed
     */
    public function getAccountList($pageSize = 10, $index = 1)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method'   => 'GetAccountList',
            'PageSize' => $pageSize,
            'Index'    => $index,
        ]));
    }

    /**
     * GetAccount
     * 
     * @param string $identifierValue
     * @param string $fieldName TaxNumber or AccountKey
     * @return mixed
     */
    public function getAccount($identifierValue, $fieldName = "TaxNumber")
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method'   => 'GetAccount',
            $fieldName => $identifierValue,
        ]));
    }

    /**
     * GetAccountKYC
     * 
     * @param string $identifier
     * @return mixed
     */
    public function getAccountKYC($identifier)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method'     => 'GetAccountKYC',
            'Identifier' => $identifier,
        ]));
    }

    /**
     * GetAccountEntry
     * 
     * @param BankAccount $account
     * @param string $startDate
     * @param string $endDate
     * @param boolean $onlyBalance
     * @param string $entryType
     * @return mixed
     */
    public function getAccountEntry(BankAccount $account, $startDate = null, $endDate = null, $onlyBalance = false, $entryType = null)
    {
        if (is_null($startDate)) $startDate = date('Y/m/d');

        if (is_null($endDate)) $endDate = date('Y/m/d');

        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method'                  => 'GetAccountEntry',
            'TaxNumber'               => $account->taxNumber,
            'StartDate'               => $startDate,
            'EndDate'                 => $endDate,
            'OnlyBalance'             => !$onlyBalance ? 'false' : 'true',
            'EntryClassificationType' => $entryType,
        ], $account->toArray())));
    }

    /**
     * GetAccountEntryPaged
     * 
     * @param BankAccount $account
     * @param string $startDate
     * @param string $endDate
     * @param boolean $onlyBalance
     * @param string $entryType
     * @param int $pageSize
     * @param int $index
     * @return mixed
     */
    public function getAccountEntryPaged(BankAccount $account, $startDate = null, $endDate = null, $onlyBalance = false, $entryType = null, $pageSize = 10, $index = 1)
    {
        if (is_null($startDate)) $startDate = date('Y/m/d');

        if (is_null($endDate)) $endDate = date('Y/m/d');

        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method'                  => 'GetAccountEntryPaged',
            'StartDate'               => $startDate,
            'EndDate'                 => $endDate,
            'OnlyBalance'             => !$onlyBalance ? 'false' : 'true',
            'EntryClassificationType' => $entryType,
            'PageSize'                => $pageSize,
            'Index'                   => $index,
        ], $account->toArray())));
    }

    /**
     * GetAccountBalance
     * 
     * @param string $taxNumber
     * @param string $startDate
     * @param string $endDate
     * @return mixed
     */
    public function getAccountBalance($taxNumber, $startDate = null, $endDate = null)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method'      => 'GetAccountEntry',
            'TaxNumber'   => $taxNumber,
            'StartDate'   => empty($startDate) ? date('Y/m/d') : $startDate,
            'EndDate'     => empty($endDate) ? date('Y/m/d') : $endDate,
            'OnlyBalance' => true
        ]));
    }

    /**
     * NewAccount
     * 
     * @param NewAccount $account
     * @return mixed
     */
    public function newAccount(AccountModel $account)
    {
        return $this->client->post(new Route(), $this->getBody(
            array_merge([
                'Method' => 'NewAccount',
            ], $account->toArray())
        ));
    }

    /**
     * LimitedAccount
     * 
     * @param AccountModel $account
     * @return mixed
     */
    public function newLimitedAccount(AccountModel $account)
    {
        return $this->client->post(new Route(), $this->getBody(
            array_merge([
                'Method' => 'LimitedAccount',
            ], $account->toArray())
        ));
    }

    /**
     * NewAccount
     * 
     * @param AccountModel $account
     * @return mixed
     */
    public function resendDocuments(AccountModel $account)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method' => 'ResendDocuments',
            'TaxNumber' => $account->holder()->taxNumber,
            'Documents' => array_map(function ($document) {
                return $document->toArray();
            }, $account->documents),
        ]));
    }

    /**
     * GetDocument
     * 
     * @param string $taxNumber
     * @param int $documentType
     * @return mixed
     */
    public function getDocumentInfo(string $taxNumber, int $documentType)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method' => 'GetDocument',
            'TaxNumber' => $taxNumber,
            'DocumentType' => $documentType,
        ]));
    }

    /**
     * UpdatePersonData
     * 
     * @param AccountModel $account
     * @return mixed
     */
    public function updatePersonData(AccountModel $account)
    {
        return $this->client->post(new Route(), $this->getBody(
            array_merge([
                'Method' => 'UpdatePersonData',
            ], $account->toArray())
        ));
    }

    /**
     * CheckAccountPerson
     * 
     * @param Person $person
     * @return mixed
     */
    public function checkAccountPerson(Person $person)
    {
        return $this->client->post(new Route(), $this->getBody(
            array_merge([
                'Method' => 'CheckAccountPerson',
            ], $person->toArray())
        ));
    }

    /**
     * CloseAccount
     * 
     * @param CloseAccount $closeAccount
     * @return mixed
     */
    public function closeAccount(CloseAccount $closeAccount)
    {
        return $this->client->post(new Route(), $this->getBody(array_merge([
            'Method' => 'CloseAccount',
        ], $closeAccount->toArray())));
    }

    /**
     * BlockAccount
     * 
     * @param string $taxNumber
     * @param string $identifier
     * @return mixed
     */
    public function blockAccount($taxNumber, $identifier = null)
    {
        return $this->client->post(new Route(), $this->getBody([
            'Method' => 'BlockAccount',
            'TaxNumber' => $taxNumber,
            'Identifier' => $identifier,
        ]));
    }

    /**
     * GetAccountOperationLimit
     * 
     * @param AccountModel $account
     * @param int $type
     * @param int $opType
     * @param int $subType
     * @return mixed
     */
    public function getAccountOperationLimit(AccountModel $account, int $type = 0, int $opType = 0, int $subType = 0)
    {
        return $this->client->post(new Route(), $this->getBody(
            array_merge([
                'Method' => 'GetAccountOperationLimit',
                'Type' => $type,
                'OperationType' => $opType,
                'SubType' => $subType,
            ], $account->toArray())
        ));
    }

    /**
     * ChangeAccountOperationLimit
     * 
     * @param AccountModel $account
     * @param int $type
     * @param int $opType
     * @param int $subType
     * @param float $minLimit
     * @param float $maxLimit
     * @return mixed
     */
    public function changeAccountOperationLimit(
        AccountModel $account,
        int $type = 0,
        int $opType = 0,
        int $subType = 0,
        float $minLimit,
        float $maxLimit
    ) {
        return $this->client->post(new Route(), $this->getBody(
            array_merge([
                'Method' => 'ChangeAccountOperationLimit',
                'Type' => $type,
                'OperationType' => $opType,
                'SubType' => $subType,
                'MinLimitValue' => $minLimit,
                'MaxLimitValue' => $maxLimit,
            ], $account->toArray())
        ));
    }
}
