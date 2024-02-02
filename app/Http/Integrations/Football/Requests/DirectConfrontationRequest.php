<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DirectConfrontationRequest extends Request
{

    public function __construct(protected $token, protected $home_team_key, protected $away_team_key)
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
        return '/?met=H2H&APIkey=' . $this->token . '&firstTeamId=' . $this->home_team_key . '&secondTeamId=' . $this->away_team_key;
    }
}
