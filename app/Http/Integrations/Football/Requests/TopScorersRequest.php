<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class TopScorersRequest extends Request
{
    public function __construct(protected $token, protected $league_key)
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
        return '/?&met=Topscorers&leagueId=' . $this->league_key . '&APIkey=' . $this->token;
    }
}
