<?php

namespace PodcastSite\Middleware\Analytics;

use Slim\Middleware;
use Slim\Route;

/**
 * A simple middleware class which appends Google Analytics code to the end of the body.
 *
 * Class GoogleAnalytics
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class GoogleAnalytics extends Middleware
{
    /**
     * Render the Google Analytics code at the end of the request body.
     */
    public function call()
    {
        // Run inner middleware and application
        $this->next->call();

        $currentRoute = $this->app
            ->router()
            ->getCurrentRoute();

        if ($currentRoute instanceof Route
            && $currentRoute->getName() !== 'rss/itunes'
        ) {
            $analyticsCode = $this
                ->app
                ->config('analytics')['code'];

            // Render and retrieve the analytics template
            $analytics = $this->app->view()->fetch(
                'middleware/analytics/google-analytics.twig',
                [
                    'analytics_code' => $analyticsCode,
                ]
            );

            // Append it to the response body
            $res = $this->app->response();
            $res->setBody(
                $res->getBody() . $analytics
            );
        }
    }
}
