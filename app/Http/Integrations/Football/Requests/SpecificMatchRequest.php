<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SpecificMatchRequest extends Request
{
    public function __construct(protected $token, protected $match_key, protected $date)
    {
    }
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '?met=Fixtures&APIkey=' . $this->token . '&from=' . $this->date . '&to=' . $this->date . '&matchId=' . $this->match_key;
    }
}
