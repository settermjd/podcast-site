# Simple Podcast Site

[![Code Climate](https://codeclimate.com/github/settermjd/podcast-site/badges/gpa.svg)](https://codeclimate.com/github/settermjd/podcast-site)
[![Test Coverage](https://codeclimate.com/github/settermjd/podcast-site/badges/coverage.svg)](https://codeclimate.com/github/settermjd/podcast-site/coverage)
[![Build Status](https://travis-ci.org/settermjd/podcast-site.svg?branch=develop)](https://travis-ci.org/settermjd/podcast-site)

The aim of this codebase is to provide a simple package for creating a
website to host a podcast. At the moment it's specific to [FreeTheGeek.fm](http://www.freethegeek.fm). But my intent is that over time it can be used by anyone.

## How it Works

Here’s how it works. The application’s based around [PHP’s Slim framework](http://www.slimframework.com), along with a series of other components. The intent here is to keep it as light and small as possible, only using and doing what it needs.

For its data source it uses simple text files, which contain a combination of [Yaml](http://yaml.org) front matter and a [Markdown](https://daringfireball.net/projects/markdown/) body as the data source for the content of the site.

The reasons for this approach are:

- After a quick back of the envelope assessment, the likelihood of having to work with a lot of information at any one time was found to be unlikely
- Text is easy to retrieve, compress, and cache
- Text is easily editable regardless of the operating system of choice or the one available
- Managing content requires only creating, updating, and deleting text files. No special interface is required, minimising the amount of code needed to be created

Yes, if you look in to the code, you’ll see that it is setup to use an adapter-based approach for loading the data. But the intent there was to allow for future growth and change, without spending too much time going down a path which may never come to pass. It was an exercise in disciplined creativity.

## Getting Started

Currently, to get started, all you need to do is clone the project and use [PHP’s built-in webserver](http://php.net/manual/en/features.commandline.webserver.php) to launch the project locally. You don’t need a dedicated server, as the built-in server should be enough.

However I’m currently working on a [Vagrant](https://www.vagrantup.com) + [Ansible](http://www.ansible.com) configuration for the project to make it as simple as possible to get started, regardless of what your operating system of choice is and whether you have any or all of the dependencies.

I’m currently reviewing the list of requirements and dependencies and will update `composer.json` shortly so that it’s clear as to what you need to have on your system for the site to work. But even when that’s done, the list won’t be too long.

## Making Contributions

If you’re keen to make contributions, please feel free. Fork the code, make your change, then submit a PR. I’ll have more in this section shortly.


