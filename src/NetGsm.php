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
    private $responseCode;
    private $api_url;
    private $username;
    private $password;
    private $header;
    private $content;
    private $gsmNumber;

    /**
     * NetGsm constructor.
     */
    public function __construct()
    {
        $this->parseConfig();
        $this->responseCode = "other";
        $this->gsmNumber = "";
        $this->content = "";
    }

    /**
     * @param mixed $api_url
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;
        return $this;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param mixed $gsmNumber
     */
    public function setGsmNumber($gsmNumber)
    {
        if (substr($gsmNumber, 0, 1) == "0") {
            $this->gsmNumber = substr($gsmNumber, 1);
        } else {
            $this->gsmNumber = $gsmNumber;
        }
        return $this;
    }

    private function checkResult()
    {
        $result = explode(" ", $this->responseCode);

        switch ($result[0]) {

            case 00:
                return trans('netgsm::messages.0');

            case 30:
                return trans('netgsm::messages.30');

            case 70:
                return trans('netgsm::messages.70');

            case 100:
                return trans('netgsm::messages.100');

            case 101:
                return trans('netgsm::messages.100');

            default:
                return trans('netgsm::messages.other');

        }
    }

    public function parseConfig()
    {
        $this->api_url = config('netgsm.apiUrl');
        $this->username = config('netgsm.username');
        $this->password = config('netgsm.password');
        $this->header = config('netgsm.header');
    }

    public function checkVariable()
    {
        if ($this->gsmNumber == "" or $this->content == "") {
            if ($this->gsmNumber == "") {
                return trans('netgsm::messages.444');
            }
            if ($this->content == "") {
                return trans('netgsm::messages.443');
            }

        } else {
            return true;
        }
    }

    public function send()
    {
        if ($this->checkVariable()) {


            $message = '<?xml version="1.0" encoding="iso-8859-9"?>
                        <mainbody>
                            <header>
                                <company>NETGSM</company>
                                <usercode>' . $this->username . '</usercode>
                                <password>' . $this->password . '</password>
                                <startdate></startdate>
                                <stopdate></stopdate>
                                <type>1:n</type>
                                <msgheader>' . $this->header . '</msgheader>
                            </header>
                            <body>
                                <msg><![CDATA[' . $this->content . ']]></msg>
                                <no>90' . $this->gsmNumber . '</no>
                            </body>
                        </mainbody>';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
            $this->responseCode = curl_exec($ch);

            return $this->checkResult();
        }
    }

}