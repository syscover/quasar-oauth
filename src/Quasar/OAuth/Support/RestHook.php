<?php namespace Quasar\OAuth\Support;

use Quasar\OAuth\Models\RestHook as RestHookModel;
use GuzzleHttp\Client;

class RestHook
{
    const ADMIN_LANG_CREATED = 'admin.lang.created';
    const CMS_ARTICLE_CREATED = 'cms.article.created';
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
                info($e->getCode() . ' - ' . $e->getMessage());

                // deactivate subscription
                $subscription->isActive = false;
                $subscription->update();
            }
        }

        return $response;
    }
}
