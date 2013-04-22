ZF2 Component Subsplits
=======================

Zend Framework 2 development is done in the zendframework/zf2 repository,
allowing for greater ease in testing components, particularly those that
have dependencies on others.

[Packagist](https://packagist.org) and [Satis](http://getcomposer.org/doc/articles/handling-private-packages-with-satis.md)
expect that individual packages live in *separate* repositories.

In order to provide discrete packages per component to Packagist, we needed
to separate our components into their own repositories. We originally did this
using [subsplit](https://github.com/dflydev/git-subsplit), which allowed us
to retain all git history. However, due to the amount of history and 
repository size, this led to a huge issue: keeping the component repositories
up-to-date was incredibly time consuming, taking more than three hours to
tag all repositories.

The solution provided in this repository is a compromise. Since the individual
component repositories are considered read-only (the canonical repository
remains the ZF2 repository), we do not have to worry about the history matching
precisely. This allows us to do the following:

- We examine each ZF2 revision to determine which components were modified
    - We then sync the files for that component from the ZF2 repository, and
      create a commit that references the origial ZF2 revision.
- When tagging, we look for the latest commit on a component repository with
  a timestamp less than or equal to the ZF2 tag's timestamp.

The process to update and/or tag components now takes seconds instead of
minutes or hours.

Preparing your checkout
-----------------------

First, run `php composer.phar install` (you will need to install Composer in
order to do this). This will setup autoloading.

Next, execute `bin/clone-repos.php`. This will clone the ZF2 and all component
repositories into your `repos/` directory, ensuring that the master and develop
branches have been checked out.
 
Usage
-----

A `Makefile` will help you keep up-to-date. Run the following:

- `make usage` will show you usage, and also show what versions each of master
  and develop will be updated to.
- `make update-master` will update both the master branch of each repository.
- `make update-develop` will update both the develop branch of each repository.
- `make tag VERSION=<version>` will create a tag in each component for the
  matching ZF2 version. You *should* run `make all` first, but if you don't,
  the master branch will be updated prior to tagging.
- `make push` will push any updates you've made to the component repositories.

Variables
---------

You may pass any of the following variables on the command line:

- `GIT` - the path to your git executable, if not on your `$PATH`
- `PHP` - the path to your PHP executable, if not on your `$PATH`
- `RSYNC` - the path to your rsync executable, if not on your `$PATH`
- `VERSION` - a ZF2 version, such as `2.1.4` or `2.0.8`; used only when calling
  `make tag`
