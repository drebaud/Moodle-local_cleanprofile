# moodle-local_cleanprofiles

Moodle plugin which correct some information in each user profile to ensure consistent data.


## Requirements

This plugin requires [Moodle](https://moodle.org) 2.7+


## Motivation for this Plugin

When users create or modify their profile, they can freely fill some fields in uppercase or lowercase and can omit accented characters in their first names.
The consequence is a list of heterogeneous information.

This plugin standardizes the following fields so that they all look the same way (i.e. last name in UPPERCASE characters):

- first name (missing accents are added thanks to a corresponding table)
- last name
- email
- city

Except for email which is always converted in lowercase, an administrator can choose for these fields if:

- all characters must be in UPPERCASE
- all characters mlust be in lowercase
- each First Character Must Be in Uppercase (Title case)

If the related choice is checked by the administrator, the plugin can correct some first names,
(ie "j.-francois" becomes "Jean-Francois", "rene" becomes "René") thanks to a database table.

## Installation

1. Unpack the plugin into `/local/cleanprofiles` within your Moodle install.
2. From the Moodle Administration block, expand *Site Administration* and click "Notifications".
3. Follow the on-screen instructions to install the plugin.

See https://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


## Usage & Settings

After installation, the plugin runs silently.

An administrator can change the settings via the page
*Site administration > Users > Profiles cleaner > Settings*

We suggest to use the excellent plugin https://moodle.org/plugins/local_adminer
for managing the table named `local_cleanprofiles` which contains the corrections of first names.


## How this Plugin Works

This plugin intercepts the events related to the creation and modification
of a user. Then, it checks and modify some fields according to the plugin's settings.

If an administrator changes the plugin's settings, it is necessary to apply the new settings
to all profiles via the page *Site administration > Users > Profiles cleaner > Apply settings to all users* because there is no way to do this automatically.


## Plugin Repositories

This plugin is published in the Moodle plugins repository:
http://moodle.org/plugins/view/local_cleanprofiles

The latest development version can be found on Github:
https://github.com/drebaud/moodle-local_cleanprofiles


## Bug and Problem Reports / Support Requests

This plugin is carefully developed and thoroughly manually tested, but bugs and problems can always appear.

Please report bugs and problems on Github:
https://github.com/drebaud/moodle-local_cleanprofiles/issues

We will do our best to solve your problems, but please note that due to limited resources we can't always provide per-case support.


## Feature Proposals

The functionality of this plugin was primarily implemented for our own local needs and published as-is to the community. We are aware that members of the community will have other needs and would love to see them solved by this plugin.

Please issue feature proposals on Github:
https://github.com/drebaud/moodle-local_cleanprofiles/issues

Please create pull requests on Github:
https://github.com/drebaud/moodle-local_cleanprofiles/pulls

We are always interested to read about your feature proposals or even get a pull request from you, but please accept that we can handle your issues only as feature _proposals_ and not as feature _requests_.


## Moodle Release Support

This plugin is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major release - please let us know on Github.


## TO DO

- Create a page for managing the records of the table `cleanprofiles`.
- Add accents according to the user language (i.e. do not change _Eric_ in _Éric_ if it is the first name of a user with "english" as default language).
