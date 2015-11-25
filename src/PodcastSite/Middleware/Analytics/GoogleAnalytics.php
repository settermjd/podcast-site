<?php

namespace PodcastSite\Middleware\Analytics;

use Slim\Middleware;

/**
 * A simple middleware class which appends Google Analytics code to the end of the body
 *
 * Class GoogleAnalytics
 * @package PodcastSite\Middleware\Analytics
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class GoogleAnalytics extends Middleware
{
    /**
     * Render the Google Analytics code at the end of the request body
     */
    public function call()
    {
        // Run inner middleware and application
        $this->next->call();

        if ($this->app->router->getCurrentRoute()->getName() !== 'rss/itunes') {
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
}