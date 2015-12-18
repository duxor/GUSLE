<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "accepted"         => "Поље :attribute мора бити прихваћено.",
    "active_url"       => "Поље :attribute није валидан URL.",
    "after"            => "Поље :attribute мора бити датум после :date.",
    "alpha"            => "Поље :attribute може садржати само слова.",
    "alpha_dash"       => "Поље :attribute може садржати само слова, бројеве и повлаке.",
    "alpha_num"        => "Поље :attribute може садржати само слова и бројеве.",
    "array"            => "Поље :attribute мора садржати низ неких ставки.",
    "before"           => "Поље :attribute мора бити датум пре :date.",
    "between"          => [
        "numeric" => "Поље :attribute мора бити између :min - :max.",
        "file"    => "Фајл :attribute мора бити између :min - :max килобајта.",
        "string"  => "Поље :attribute мора бити између :min - :max карактера.",
        "array"   => "Поље :attribute мора бити између :min - :max ставки.",
    ],
    "boolean"          => "Поље :attribute мора бити тачно или нетачно",
    "confirmed"        => "Потврда пољa :attribute се не поклапа.",
    "date"             => "Поље :attribute није важећи датум.",
    "date_format"      => "Поље :attribute не одговара према формату :format.",
    "different"        => "Поља :attribute и :other морају бити различита.",
    "digits"           => "Поље :attribute мора садржати :digits цифри.",
    "digits_between"   => "Поље :attribute мора бити између :min и :max шифри.",
    "email"            => "Формат поља :attribute није валидан.",
    "exists"           => "Одабрано поље :attribute није валидно.",
    "filled"           => "Поље :attribute је обавезно.",
    "image"            => "Поље :attribute мора бити слика.",
    "in"               => "Одабрано поље :attribute није валидно.",
    "integer"          => "Поље :attribute мора бити број.",
    "ip"               => "Поље :attribute мора бити валидна IP адреса.",
    'json'             => 'The :attribute must be a valid JSON string.',
    "max"              => [
        "numeric" => "Поље :attribute мора бити мање од :max.",
        "file"    => "Поље :attribute мора бити мање од :max килобајта.",
        "string"  => "Поље :attribute мора садржати мање од :max карактера.",
        "array"   => "Поље :attribute не сме да има више од :max ставки.",
    ],
    "mimes"            => "Поље :attribute мора бити фајл типа: :values.",
    "min"              => [
        "numeric" => "Поље :attribute мора бити најмање :min.",
        "file"    => "Фајл :attribute мора бити најмање :min килобајта.",
        "string"  => "Поље :attribute мора садржати најмање :min карактера.",
        "array"   => "Поље :attribute мора садржати најмање :min ставку.",
    ],
    "not_in"           => "Одабрани елеменат поља :attribute није валидан.",
    "numeric"          => "Pоље :attribute мора бити број.",
    "regex"            => "Формат поља :attribute није валидан.",
    "required"         => "Pоље :attribute је обавезно.",
    "required_if"      => "Pоље :attribute је потребно када поље :other садржи :value.",
    "required_with"    => "Pоље :attribute је потребно када поље :values је присутан.",
    "required_with_all" => "Pоље :attribute је побавезно када је :values приказано.",
    "required_without" => "Pољеe :attribute је потребно када поље :values није присутан.",
    "required_without_all" => "Pоље :attribute је потребно када ниједан од следећих поља :values нису присутни.",
    "same"             => "Pоља :attribute и :other се морају поклапати.",
    "size"             => [
        "numeric" => "Pоље :attribute мора бити :size.",
        "file"    => "Фајл :attribute мора бити :size килобајта.",
        "string"  => "Pоље :attribute мора бити :size карактера.",
        "array"   => "Pоље :attribute мора садржатиi :size ставки.",
    ],
    "string"           => "Pоље :attribute мора садржати слова.",
    "timezone"         => "Pоље :attribute мора бити исправна временска зона.",
    "unique"           => "Pоље :attribute већ постоји.",
    "url"              => "Формат поља :attribute не важи.",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [],
];