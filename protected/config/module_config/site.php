<?php
return array(
    'urlManager' => array(
        "" => "site/index",
        "kontakty" => "site/contacts",
        "search" => "site/search",
        "<_c:(profile|user|client)>" => "<_c>/index",
        "<_c:(profile|user|client)>/<_a>" => "<_c>/<_a>",
        "<_a:(hslogin|logout|register)>" => "user/<_a>",
        "<_c>/<_a:(captcha)>/refresh" => "<_c>/<_a>",
        "<_c>/<_a:(captcha)>/<v>" => "<_c>/<_a>",
        "<url:([0-9a-z\/_-]+)>/" => "site/page",
    )
);