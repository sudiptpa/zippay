# Omnipay: ZipPay

**ZipPay driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements ZipPay support for Omnipay.

[![StyleCI](https://github.styleci.io/repos/180097262/shield?branch=master&style=flat)](https://github.styleci.io/repos/180097262)
[![Latest Stable Version](https://poser.pugx.org/sudiptpa/zippay/v/stable)](https://packagist.org/packages/sudiptpa/zippay)
[![Total Downloads](https://poser.pugx.org/sudiptpa/zippay/downloads)](https://packagist.org/packages/sudiptpa/zippay)
[![License](https://poser.pugx.org/sudiptpa/zippay/license)](https://packagist.org/packages/sudiptpa/zippay)

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "sudiptpa/zippay": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Credits

This package was originally created by [Daniel Condie](https://github.com/dcon138) as [Omnipay ZipPay](https://github.com/ignited/omnipay-zippay), which orignally had support for Omnipay 3.x support only. So, in this package i've added the Omnipay 2.x support. I had my own requirements for my client so had to create a seperate package for Omnipay 2.x support.

