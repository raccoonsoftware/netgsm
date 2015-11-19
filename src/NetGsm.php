<?php
    /**
     * Created by PhpStorm.
     * User: mehmet
     * Date: 15.11.2015
     * Time: 02:44
     */

    namespace RaccoonSoftware\NetGsm;


    class NetGsm
    {
        private static function resultCode($code)
        {
            $result = explode(" ", $code);

            switch ($result[0]) {

                case 00:
                    return trans('netgsm::messages.0');
                    break;

                case 30:
                    return trans('netgsm::messages.30');
                    break;

                case 70:
                    return trans('netgsm::messages.70');
                    break;

                case 100:
                    return trans('netgsm::messages.100');
                    break;

                case 101:
                    return trans('netgsm::messages.100');
                    break;
                default:
                    return trans('netgsm::messages.other');
                    break;
            }
        }

        public static function send($number, $content)
        {
            $api_url = config('netgsm.apiUrl');
            $username = config('netgsm.username');
            $password = config('netgsm.password');
            $header = config('netgsm.header');

            $message = '<?xml version="1.0" encoding="iso-8859-9"?>
                        <mainbody>
                            <header>
                                <company>NETGSM</company>
                                <usercode>' . $username . '</usercode>
                                <password>' . $password . '</password>
                                <startdate></startdate>
                                <stopdate></stopdate>
                                <type>1:n</type>
                                <msgheader>' . $header . '</msgheader>
                                </header>
                                <body>
                                <msg><![CDATA[' . $content . ']]></msg>
                                <no>90' . $number . '</no>
                                </body>
                        </mainbody>';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
            $result = curl_exec($ch);


            return self::resultCode($result);


        }

    }