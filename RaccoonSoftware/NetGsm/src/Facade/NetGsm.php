<?php
    /**
     * Created by PhpStorm.
     * User: mehmet
     * Date: 15.11.2015
     * Time: 02:45
     */

    namespace RaccoonSoftware\NetGsm\Facade;


    use Illuminate\Support\Facades\Facade;

    class NetGsm extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return 'netgsm';
        }

    }