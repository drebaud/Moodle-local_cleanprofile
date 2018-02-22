# moodle-local_cleanprofiles

Moodle plugin which correct some information in the user profile


## Requirements


This plugin requires [Moodle](https://moodle.org) 2.7+


## Motivation for this plugin

When users create or modify their profile, they can freely write their
names in uppercase or lowercase, and so on. The consequence is a list
of heterogeneous information.

This plugin standardizes some fields so that they are all written
in the same way (i.e. last name in UPPERCASE characters).


## Installation

1. Unpack the plugin into `/local/cleanprofiles` within your Moodle install.
2. From the Moodle Administration block, expand *Site Administration* and click "Notifications".
3. Follow the on-screen instructions to install the plugin.

See https://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


## Usage & Settings

After installing the plugin, it runs silently.


## How this plugin works

This plugin intercepts the events related to the creation and modification
of a user. Then, it checks and modify some fields.

If an administrator changes the settings, it is necessary to update
the `user` table via the page *Site administration > Users > Apply cleaning rules to all users*


## Plugin repositories

This plugin is published in the Moodle plugins repository:
http://moodle.org/plugins/view/local_cleanprofiles

The latest development version can be found on Github:
https://github.com/drebaud/moodle-local_cleanprofiles


## Bug and problem reports / Support requests

This plugin is carefully developed and thoroughly tested, but bugs and problems can always appear.

Please report bugs and problems on Github:
https://github.com/drebaud/moodle-local_cleanprofiles/issues

We will do our best to solve your problems, but please note that due to limited resources we can't always provide per-case support.


## Feature proposals

Due to limited resources, the functionality of this plugin is primarily implemented for our own local needs and published as-is to the community. We are aware that members of the community will have other needs and would love to see them solved by this plugin.

Please issue feature proposals on Github:
https://github.com/drebaud/moodle-local_cleanprofiles/issues

Please create pull requests on Github:
https://github.com/drebaud/moodle-local_cleanprofiles/pulls

We are always interested to read about your feature proposals or even get a pull request from you, but please accept that we can handle your issues only as feature _proposals_ and not as feature _requests_.


## Moodle release support

Due to limited resources, this plugin is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major release - please let us know on Github.


## Translating this plugin

This Moodle plugin is shipped with english and french languages packs only. All translations into other languages must be managed through AMOS (https://lang.moodle.org) by what they will become part of Moodle's official language pack.

As the plugin creator, we manage the translation into french for our own local needs on AMOS. Please contribute your translation into all other languages in AMOS where they will be reviewed by the official language pack maintainers for Moodle.


## Right-to-left support

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on Github with modifications.

## To do

Create a page for managing the translations of first names handled in the table `cleanprofiles` (ex. `Etienne` becomes `Étienne`)