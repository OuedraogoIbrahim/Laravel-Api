<?php

namespace App\Http\Integrations\Football\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class MatchesPlayedTodayRequest extends Request
{
    public function __construct(protected $token, protected $competition_key, protected $debut, protected $fin)
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
        if ($this->debut == 1 && $this->fin == 1) {

            $debut = '&from=' . now()->toDateString();
            $fin = '&to=' . now()->toDateString();
            return '?met=Fixtures&APIkey=' . $this->token  . $debut . $fin . '&leagueId=' . $this->competition_key;
        } else {
            return '?met=Fixtures&APIkey=' . $this->token . '&from=' . $this->debut . '&to=' . $this->fin . '&leagueId=' . $this->competition_key;
        }
    }
}
