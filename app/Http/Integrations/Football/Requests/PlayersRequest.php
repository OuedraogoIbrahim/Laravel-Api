<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class PlayersRequest extends Request
{
    public function __construct(protected $token, protected $player_key)
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
        return '/?met=Players&playerId=' . $this->player_key . '&APIkey=' . $this->token;
    }
}
