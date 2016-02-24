<?php

namespace PodcastSite\Test\unit\Middleware;

use PodcastSite\Middleware\Analytics\GoogleAnalytics;
use Slim\Http\Response;
use Slim\Middleware;
use Slim\Route;
use Slim\Router;
use Slim\Slim;
use Slim\View;

class GoogleAnalyticsTest extends \PHPUnit_Framework_TestCase
{
    public function testCanRenderGoogleAnalytics()
    {
        $route = $this->getMockBuilder(Route::class)
            ->disableOriginalConstructor()
            ->getMock();

        $route->expects($this->once())
            ->method('getName')
            ->willReturn('home');

        $router = $this->getMock(Router::class);
        $router->expects($this->once())
            ->method('getCurrentRoute')
            ->willReturn($route);

        $view = $this->getMockBuilder(View::class)
            ->disableOriginalConstructor()
            ->getMock();

        $view->expects($this->once())
            ->method('fetch');

        $app = $this->getMockBuilder(Slim::class)
            ->disableOriginalConstructor()
            ->getMock();

        $app->expects($this->once())
            ->method('view')
            ->willReturn($view);

        $app->expects($this->once())
            ->method('router')
            ->willReturn($router);

        $response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response->expects($this->once())
            ->method('getBody')
            ->willReturn('');

        $app->expects($this->once())
            ->method('response')
            ->willReturn($response);

        $next = $this->getMock(Middleware::class);
        $next->expects($this->once())
            ->method('call');

        $analytics = new GoogleAnalytics();
        $reflection = new \ReflectionClass($analytics);

        $property = $reflection->getProperty('next');
        $property->setAccessible(true);
        $property->setValue($analytics, $next);

        $property = $reflection->getProperty('app');
        $property->setAccessible(true);
        $property->setValue($analytics, $app);

        $analytics->call();
    }

    public function testAnalyticsCodeIsNotRenderedOnItunesRoute()
    {
        $route = $this->getMockBuilder(Route::class)
            ->disableOriginalConstructor()
            ->getMock();

        $route->expects($this->once())
            ->method('getName')
            ->willReturn('rss/itunes');

        $router = $this->getMock(Router::class);
        $router->expects($this->once())
            ->method('getCurrentRoute')
            ->willReturn($route);

        $app = $this->getMockBuilder(Slim::class)
            ->disableOriginalConstructor()
            ->getMock();

        $app->expects($this->once())
            ->method('router')
            ->willReturn($router);

        $next = $this->getMock(Middleware::class);
        $next->expects($this->once())
            ->method('call');

        $analytics = new GoogleAnalytics();
        $reflection = new \ReflectionClass($analytics);

        $property = $reflection->getProperty('next');
        $property->setAccessible(true);
        $property->setValue($analytics, $next);

        $property = $reflection->getProperty('app');
        $property->setAccessible(true);
        $property->setValue($analytics, $app);

        $analytics->call();
    }

    public function testAnalyticsCodeIsRenderedOn404Page()
    {
        $router = $this->getMock(Router::class);
        $router->expects($this->once())
            ->method('getCurrentRoute')
            ->willReturn(null);

        $app = $this->getMockBuilder(Slim::class)
            ->disableOriginalConstructor()
            ->getMock();

        $app->expects($this->once())
            ->method('router')
            ->willReturn($router);

        $next = $this->getMock(Middleware::class);
        $next->expects($this->once())
            ->method('call');

        $analytics = new GoogleAnalytics();
        $reflection = new \ReflectionClass($analytics);

        $property = $reflection->getProperty('next');
        $property->setAccessible(true);
        $property->setValue($analytics, $next);

        $property = $reflection->getProperty('app');
        $property->setAccessible(true);
        $property->setValue($analytics, $app);

        $analytics->call();
    }
}
