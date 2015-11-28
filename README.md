Laravel Net GSM Package
===

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/raccoonsoftware/netgsm?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
[![Latest Stable Version](https://poser.pugx.org/racoonsoftware/netgsm/v/stable)](https://packagist.org/packages/racoonsoftware/netgsm)
[![Total Downloads](https://poser.pugx.org/racoonsoftware/netgsm/downloads)](https://packagist.org/packages/racoonsoftware/netgsm)
[![Latest Unstable Version](https://poser.pugx.org/racoonsoftware/netgsm/v/unstable)](https://packagist.org/packages/racoonsoftware/netgsm)
[![License](https://poser.pugx.org/racoonsoftware/netgsm/license)](https://packagist.org/packages/racoonsoftware/netgsm)

- **AUTHOR** MEHMET NURI OZTURK mehmet@raccoonsoftware.net


## Installation

You should install this package through Composer.

Edit your project's `composer.json` file to require `raccoonsoftware/netgsm`.

    "require": {
        "raccoonsoftware/netgsm": "*"
    },

Next, update Composer from the Terminal:
    `composer update`

Once this operation completes, the final step is to add the service provider.
Open `app/config/app.php`, and add a new item to the providers array.

  `'RaccoonSoftware\NetGsm\NetGsmServiceProvider::class',`

And add a new item to the aliases array.

  `'NetGsm' => 'RaccoonSoftware\NetGsm\Facade\NetGsm::class',`
  
 Give this command  
  `php artisan vendor:publish`
  
  and  open config/netgsm.php file and fill necesary information.
  
  

## Usage

Option 1

    use RaccoonSoftware\NetGsm\NetGsm;
    
    Route::get('/', function () {
        
        $sms = new NetGsm();
        
        return $sms->setGsmNumber("5xxxxxxxxxx")->setContent("Hello World!")->send();
    });

Option 2

    use RaccoonSoftware\NetGsm\NetGsm;
    
    Route::get('/', function () {
        
        $sms = new NetGsm();
        $sms->setGsmNumber("5xxxxxxxxx");
        $sms->setContent("Hello New World");
        
        return $sms->send();
    });

  