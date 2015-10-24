# Deployment

Here's a quick run through of the deployment process for the application, whether for installing it, or for updating a live application, to bring it up to a new commit/release.

## Installation

The application only needs to do three things to be installed. These are:

1. Clone the source
2. Run `composer install`
3. Check the permissions on the cache directories

It has no hard dependencies on external caching servers, database servers, or the like. So long as the source is in place and composer's installed the third party libraries, then it's right to go.

## Update

As with the installation process, updating the application's also quite straight-forward. The only things required to be done are:

1. Update the source
2. Rebuild the Composer dependencies
3. Clear the cache directories


