<?php

namespace PodcastSite\Middleware\Analytics;

use Slim\Middleware;

/**
 * A simple middleware class which appends Google Analytics code to the end of the body
 *
 * Class GoogleAnalytics
 * @package PodcastSite\Middleware\Analytics
 */
class GoogleAnalytics extends Middleware
{
    public function call()
    {
        // Run inner middleware and application
        $this->next->call();

        // Render and retrieve the analytics template
        $analytics = $this->app->view()->fetch(
            'middleware/analytics/google-analytics.twig', [
                'analytics_code' => $this->app->config->analytics->code
            ]
        );

        // Append it to the response body
        $res = $this->app->response;
        $body = $res->getBody() . $analytics;
        $res->setBody($body);
    }
}