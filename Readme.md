## MVP - Minimum Viable Product
 _For PHP using composer initiated AutoLoad_

When PHP is deployed with Composer it allows easy distribution and updating.

This simple example is agnostic - for my use I extend it with my own framework, here it is extended using a _Markdown Parser_.

### Install (Windows 10)
1. Install Pre-Requisits
   1. Install PHP : http://windows.php.net/download/
      * Install the non threadsafe binary
        * Test by running php -v from the command prompt
          * If required install the VC++ runtime available from the php download page
        * by default there is no php.ini (required)
         * copy php.ini-production to php.ini

   2. Install Git : https://git-scm.com/
      * Install the *Git Bash Here* option
   3. Install Composer : https://getcomposer.org/

2. Setup a new project
   ```
   composer create-project bravedave/mvp <my-project> @dev
   ```

2. Install dependencies &amp; run
   ```
   cd <my-project>
   composer update
   run.cmd
   ```

   ... the result is visible at http://localhost/

### Extend with _erusev/parsedown_
* Install Extension &amp; run
   ```
   composer require erusev/parsedown
   run.cmd
   ```

### more ..
Look at src/app/launcher.php ...

