# CakePHP Fixtures

[![Build Status](https://travis-ci.org/LubosRemplik/CakePHP-Fixtures.svg)](https://travis-ci.org/LubosRemplik/CakePHP-Fixtures)
[![Latest Stable Version](https://poser.pugx.org/lubos/fixtures/v/stable.svg)](https://packagist.org/packages/lubos/fixtures) 
[![Total Downloads](https://poser.pugx.org/lubos/fixtures/downloads.svg)](https://packagist.org/packages/lubos/fixtures) 
[![Latest Unstable Version](https://poser.pugx.org/lubos/fixtures/v/unstable.svg)](https://packagist.org/packages/lubos/fixtures) 
[![License](https://poser.pugx.org/lubos/fixtures/license.svg)](https://packagist.org/packages/lubos/fixtures)

CakePHP Fixtures plugin to read fixtures and creating tables with data from tests.

## Installation & Configuration

```
composer require lubos/fixtures
```

Load plugin in bootstrap.php file

```
bin/cake plugin load Fixtures
```

## Usage

run `bin/cake` to see shells and its options  

Examples:  
```
bin/cake fixtures createTable "Fixtures\Fixture\UsersFixture"
bin/cake fixtures createTable "Fixtures\Fixture\CategoriesFixture"
bin/cake fixtures createTable "Fixtures\Fixture\ProductsFixture"
bin/cake fixtures createTable "Fixtures\Fixture\ArticlesFixture"

bin/cake fixtures insert "Fixtures\Fixture\UsersFixture"
```

## Bugs & Features

For bugs and feature requests, please use the issues section of this repository.

If you want to help, pull requests are welcome.  
Please follow few rules:  

- Fork & clone
- Code bugfix or feature
- Follow [CakePHP coding standards](https://github.com/cakephp/cakephp-codesniffer)
