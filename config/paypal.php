<?php
return [
    // set your paypal credential
    'client_id' => 'AcwEmuJot1Vp5QCkuDCx4_9pEaXtqot956MEIYNaGk9ob7sSXrObQpGiOR3RaBuwc78QW59_U3oV2ZtE',
    'secret' => 'EE9lsP1Ajqmzn-ibk6ZOXuDkgBWUUWfEV7APLa5z6mPOf5TreTlhIxzYGKaoGSMW1-gM8xTZq2lvpu8Q',

    /**
     * SDK configuration
     */
    'settings' => [
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'live',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ],
];