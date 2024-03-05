<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class LiveRequest extends Request
{


    public function __construct(protected $token, protected $competition)
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
        return '?met=Livescore&APIkey=' . $this->token . '&leagueId=' . $this->competition;
    }
}
