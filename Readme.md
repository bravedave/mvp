# MVP - Minimum Viable Product
> For PHP using composer initiated AutoLoad

When PHP is deployed with Composer it allows easy distribution and updating.

This simple example is agnostic - for my use I extend it with my own framework, here it is extended using a _Markdown Parser_.

## Install (Windows 10)
1. Install Pre-Requisits
   * Install PHP : http://windows.php.net/download/
     * Install the non threadsafe binary
       * Test by running php -v from the command prompt
         * If required install the VC++ runtime available from the php download page
       * by default there is no php.ini (required)
         * copy php.ini-production to php.ini

   * Install Git : https://git-scm.com/
     * Install the *Git Bash Here* option
   * Install Composer : https://getcomposer.org/

2. Clone this Repo
   ```
   git clone https://github.com/bravedave/mvp.git mvp
   ```

2. Install dependencies &amp; run
   ```
   cd mvp
   composer update
   run.cmd
   ```

   ... the result is visible at http://localhost/

## Extend with _erusev/parsedown_
1. Install Extension &amp; run
   ```
   composer require erusev/parsedown
   run.cmd
   ```

## more ..
Look at src/application.php ...

