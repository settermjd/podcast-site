<?php

require 'vendor/autoload.php';
require 'recipe/composer.php';

/**
 * Define Servers
 */
localServer('testing')
    ->user('mattsetter')
    ->stage('testing')
    ->env('deploy_path', '~/Workspace/settermjd/PHP/podcast-site-test-deployment/');

server('production', '192.168.10.10', '22')
    ->user('vagrant')
    ->password('vagrant')
    ->stage('production')
    ->env('deploy_path', '/home/vagrant/podcast-site-testing');

/**
 * Settings
 */
set('repository', 'https://github.com/settermjd/podcast-site.git');
set('keep_releases', 3);
set('writable_dirs', ['storage/cache/app-cache', 'storage/cache/template-cache']);

/**
 * Define Tasks
 */
task('deploy:done', function () {
    write('Deploy done!');
})->desc("When deployment's completed");

task('reload:php-fpm', function () {
    run('sudo /usr/sbin/service php5-fpm reload');
})->desc('Reload PHP5 FPM');

task('reload:nginx', function () {
    run('sudo /usr/sbin/service nginx reload');
})->desc('Reload Nginx');

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:symlink',
    'cleanup'
])->desc("Main deployment process");

after('deploy', 'reload:php-fpm');
after('deploy', 'reload:nginx');
after('deploy', 'deploy:done');
