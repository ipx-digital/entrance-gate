<?php

namespace Statamic\Addons\EntranceGate;

use Statamic\Extend\Controller;

class EntranceGateController extends Controller
{
    /**
     * Maps to your route definition in routes.yaml
     *
     * @return mixed
     */
    public function index()
    {
        return $this->view('index');
    }

    public function getConfirmed()
    {
        session()->set('confirmed', 'true');

        return response('Done', 200);
    }
}
