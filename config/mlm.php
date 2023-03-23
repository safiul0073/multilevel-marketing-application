<?php

return [
    "bonus" => [
        "matching" => [
            "pair_types"    => ["Auto", "Flash:Carry", "Carry:Flash", "Carry:Carry", "Flash:Flash"],
            "pair_type"     => "Auto",
            "pair_value"    => 31,
            "pair_amount"   => 100,
            "in_day"        => 1,
            "end_time"      => date('H:i', strtotime( "11:59 PM" ))
        ],
        "gen"       => [10,9,8,7,6,2,2,2,2,2],
        "incentive" => 100
    ],
    "balance_transfer" => 50,
    "footer" => [
        "office" => [
            "location"  => "@142 Poran Masto Road 902100 Bangde Britatu Sans Francisco",
            "phone"     => "+01234567890",
            "email"     => "example@gmail.com",
        ],
        "footer_content1" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad maiores quia dolorem dignissimos sit consequuntur eaque.",
        "footer_content2" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad maiores quia dolorem dignissimos sit consequuntur eaque, nihil nesciunt id rem ullam magnam, nostrum beatae. Dolore possimus molestiae eius accusantium quibusdam.",
        "all_right_reserved" => "2020 Your Company, Inc. All rights reserved."
    ],

    "home_content" => [
        "top_h1_first" => "We will start at the root.",
        "top_h1_second" => "We will reach the peak.",
        "top_p_tag" => "Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.",
    ],
    "logo" => config('app.url') . "/frontend/images/logo.png",
];
