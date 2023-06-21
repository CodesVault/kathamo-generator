# Kathamo Generator
Kathamo Generator is the CLI for Kathamo framework.
<br>
It can create new plugin with Kathamo framework and also can generate Controller, Migration file, Middleware, etc components for Kathamo framework.

<br>

## Documentation
To know about Kathamo framework, visit [kathamo.dev](https://kathamo.dev)

<br>
<br>

## Installation

Install using composer as global package.
```bash
composer global require codesvault/kathamo-generator
```

<br>
Add Composer's system-wide vendor bin directory in your $PATH, so that Kathamo executable can be located by your system.

* macOS: `$HOME/.composer/vendor/bin`
* Windows: `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin`
* GNU / Linux Distributions: '$HOME/.config/composer/vendor/bin or $HOME/.composer/vendor/bin'

<br>

If you've already have added composer's bin folder to your path, you can use the command `kathamo` right away from your terminal.

However, if you prefer not to modify the `PATH` variable, you can also create an alias in your `.bashrc` or `.zshrc` file like below:
<br>

`alias kathamo="$(composer config -g home)/vendor/bin/kathamo"`

<br>
<br>

## Usage

Create a new plugin with Kathamo framework. From your terminal run this command

```bash
kathamo create:plugin
```

<br>

Create Controller, Migration file, Middleware, Service.

```php bash
kathamo make:controller
kathamo make:migration
kathamo make:middleware
kathamo make:service
```
