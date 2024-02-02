<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class TeamRequest extends Request
{
    public function __construct(protected $token, protected $team_name)
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
        return '/?&met=Teams&teamName=' . $this->team_name . '&APIkey=' . $this->token;
    }
}
