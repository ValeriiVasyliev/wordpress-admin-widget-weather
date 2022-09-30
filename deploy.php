<?php

namespace Deployer;

require 'recipe/common.php';
// Set the options with which the `composer install` command should be invoked
set('composer_options', '{{composer_action}} --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');

// Set how many releases should be kept by Deployer on the server.
// 3 means that we can go 3 releases back. -1 keeps all releases
set('keep_releases', 3);

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

//set('writable_use_sudo', true);

set('writable_mode', 'chmod');

set('http_group', 'www-data');

set('http_user', 'deployer');

set('default_timeout', 1500);

// Load options and hosts from inventory.
inventory('deploy.yml');

// Shared files/dirs between deploys
set('shared_files', [
	'wp-config.php',
	'wp-content/object-cache.php',
	'wp-content/advanced-cache.php',
	'.htaccess'
]);
set('shared_dirs', [
	'vendor',
	'wp-content/wonolog',
	'wp-content/uploads',
	'wp-content/cache',
	'wp-content/w3tc-config',
	'wp-content/languages',
	'.well-known'
]);

// Writable dirs by web server
set('writable_dirs', [
	'wp-content'
]);

set('bin/composer', 'php -d memory_limit=-1  /usr/local/bin/composer');

set('composer_action', 'install');

set('composer_options', '{{composer_action}} --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction --no-scripts');

// Remove unnecessary stuff
set('clear_paths', [
	'.git',
	'.github',
	'.gitignore',
	'deploy.php',
	'vendor',
	'deploy.yml',
	'composer.json',
	'composer.lock',
	'wp-cli.yml',
	'.phpcs.xml',
	'README.md',
	'wp-content/plugins/akismet',
	'wp-content/plugins/hello.php',
	'wp-content/themes/twentynineteen',
	'wp-content/themes/twentytwenty',
	'wp-content/themes/twentytwentyone',
	'wp-content/themes/vormats/gulp',
	'.githooks'
]);

// Tasks
desc('Deploy your project');
task('deploy', [
	'deploy:info',
	'deploy:prepare',
	'deploy:lock',
	'deploy:release',
	'deploy:update_code',
	'install_composer_dependencies',
	'install_nodejs_dependencies',
	'webpack_build',
	'deploy:shared',
	'deploy:writable',
	'deploy:vendors',
	'deploy:clear_paths',
	'deploy:symlink',
	'deploy:unlock',
	'cleanup',
	'success'
]);

task('install_composer_dependencies', function () {
	run('cd {{release_path}} && composer build', [
		'timeout' => 1800,
	]);
});


task('install_nodejs_dependencies', function () {
	run('cd {{release_path}}/wp-content/themes/vormats/gulp/ && npm install', [
		'timeout' => 1800,
	]);
});

task('webpack_build', function () {
	run('cd {{release_path}}/wp-content/themes/vormats/gulp/ && npm run build', [
		'timeout' => 1800,
	]);
});

// Install WordPress.
desc('Install WordPress');
task('deploy:wp', '
	wp core download;
');


after('deploy:vendors', 'deploy:wp');

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');