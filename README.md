# Kathamo Generator
Kathamo Generator is a command line tool (CLI) to generate new project with Kathamo framework.
<br>
It also can generate Controller, Migration file, Middleware, etc components for Kathamo framework.

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

If you've already added composer's bin folder to your path, you can use the command `kathamo` right away from your cli.

However, if you prefer not to modify the `PATH` variable, you can also create an alias in your `.bashrc` or `.zshrc` file like this.
```bash
alias kathamo="$(composer config -g home)/vendor/codesvault/kathamo-generator/bin/kathamo"
```

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
