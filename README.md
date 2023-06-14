# Kathamo Generator
Kathamo Generator is a command line tool to generate new project with Kathamo framework.
<br>
All mejor components are modularized, separate composer packages.

<br>
<br>

## Installation

Install using composer as global package.
```bash
composer global require codesvault/kathamo-generator
```

Then set path as alias in your `.bashrc` or `.zshrc` file like this.
```bash
alias kathamo=""$(composer config -g home)/vendor/codesvault/kathamo-generator/bin/kathamo""
```

<br>
<br>

## Usage

Create a new plugin with Kathamo framework.
<br>
Create a new directory and from the terminal `cd` into that directory, then run:

```php bash
kathamo create --new
```
