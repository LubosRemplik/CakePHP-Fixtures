# CakePHP Fixtures

[![Build Status](https://travis-ci.org/LubosRemplik/CakePHP-Fixtures.svg)](https://travis-ci.org/LubosRemplik/CakePHP-Fixtures)
[![Latest Stable Version](https://poser.pugx.org/lubos/cakephp-fixtures/v/stable.svg)](https://packagist.org/packages/lubos/cakephp-fixtures) 
[![Total Downloads](https://poser.pugx.org/lubos/cakephp-fixtures/downloads.svg)](https://packagist.org/packages/lubos/cakephp-fixtures) 
[![Latest Unstable Version](https://poser.pugx.org/lubos/cakephp-fixtures/v/unstable.svg)](https://packagist.org/packages/lubos/cakephp-fixtures) 
[![License](https://poser.pugx.org/lubos/cakephp-fixtures/license.svg)](https://packagist.org/packages/lubos/cakephp-fixtures)

CakePHP Fixtures plugin to read fixtures and creating tables with data from tests.

## Installation & Configuration

```
composer require lubos/cakephp-fixtures
```

Load plugin in bootstrap.php file

```
bin/cake plugin load Fixtures
```

## Usage

run `bin/cake` to see shells and its options  

Example:  
```
bin/cake fixtures createTable "\Cake\Test\Fixture\ArticlesFixture"

bin/cake fixtures insert "\Cake\Test\Fixture\ArticlesFixture"
```

## Bugs & Features

For bugs and feature requests, please use the issues section of this repository.

If you want to help, pull requests are welcome.  
Please follow few rules:  

- Fork & clone
- Code bugfix or feature
- Follow [CakePHP coding standards](https://github.com/cakephp/cakephp-codesniffer)
