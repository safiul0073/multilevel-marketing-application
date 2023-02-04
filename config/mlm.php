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
    "office" => [
        "location"  => "@142 Poran Masto Road 902100 Bangde Britatu Sans Francisco",
        "phone"     => "+01234567890",
        "email"     => "example@gmail.com"
    ],
    "logo" => "/image/logo.png"
];
