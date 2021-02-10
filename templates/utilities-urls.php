<?php namespace ProcessWire;

return array(	
    "root" => $config->urls->root,
    "domain" => $config->httpHost,
    "logInOutURL" => $pages->get("template=nav-login")->url,
    "errorHandlerURL" => $pages->get("template=utilities-error-handler")->url,
    "forgotPassword" => $pages->get("template=services-forgotten-password")->url,
    "ajaxURL" => $pages->get("template=utilities-ajax-interactions")->url
);