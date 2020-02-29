<?php namespace Quasar\OAuth\Support;

use Quasar\OAuth\Models\RestHook as RestHookModel;
use GuzzleHttp\Client;

class RestHook
{
    const OAUTH_LOGIN_SUCCESSFUL = 'oauth.login.successful';

    public static function fire($event, $data)
    {
        $client = new Client;
        $subscriptions = RestHookModel::where('event', $event)->where('is_active', true)->get();
        $response = [];

        foreach($subscriptions as $subscription)
        {
            try 
            {
                $response[] = $client->request('POST', $subscription->url, [
                    'json' => $data
                ]);
            } 
            catch (\Exception $e) 
            {
                info($e->getMessage());
                info($e->getCode());

                // deactivate subscription
                $subscription->isActive = false;
                $subscriptions->update();
            }
        }

        return $response;
    }
}
