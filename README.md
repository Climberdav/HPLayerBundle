Hyperplanning Abstract Layer Bundle
====

[![Build Status](https://travis-ci.org/Climberdav/HPLayerBundle.svg)](https://travis-ci.org/Climberdav/HPLayerBundle.svg)
[![Coverage Status](https://coveralls.io/repos/Climberdav/HPLayerBundle/badge.svg)](https://coveralls.io/r/Climberdav/HPLayerBundle)
[![Latest Stable Version](https://poser.pugx.org/climberdav/hp-layer/v/stable)](https://packagist.org/packages/climberdav/hp-layer)

This bundle provide an abstract layer of [Hyperplanning WebService](http://index-education.com/fr/serviceWebHP.php).

## Features

- An admin interface to add manage new reference to Hyperplanning ServiceWeb with actions:
    - test validity of the WebService
    - enabled/disable a WebService
    
- For each server, you define: 
  - a friendly name
  - an IP addresss
  - the `wsdl` root (default hpsw)
  - the first date of the base, which can be verified after
  - a previous linked server (previous year for exemple)

- Translated in french, english

## Screenshots
![list](Resources/doc/images/server-hyperplanning.png)

![new](Resources/doc/images/server-hyperplanning-new.png)

## Documentation

For usage documentation, see [Documentation](Resources/doc/index.md)

### Licence
This bundle is under the MIT license. See the [complete licence](Resources/meta/LICENCE) for info.