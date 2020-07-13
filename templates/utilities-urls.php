<?php namespace ProcessWire;

return array(	
    "root" => $config->urls->root,
    "domain" => $config->httpHost,
    "logInOutURL" => $pages->get(1017)->url,
    "errorHandlerURL" => $pages->get(1084)->url,
    "forgotPassword" => $pages->get(1089)->url,
    "searchURL" => $pages->get(1274)->url
);