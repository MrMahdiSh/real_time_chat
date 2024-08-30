<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'unique' => ':attribute قبلا انتخاب شده است.',

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
        ]

        , 'gender' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]
        , 'user_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]  , 'user_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]  , 'user_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]  , 'blog_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'ex_to' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'ex_role' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'rew_title' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'rew_date' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'reserve_price' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'tax_price' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'factor_description' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'bank_name' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'account_no' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'number' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'current_password' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'birth_day' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'clinic_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]


        , 'about_me' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'address_1' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]
        , 'phone_1' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]
        , 'address_2' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]
        , 'phone_2' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'state_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'ex_from' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'ex_title' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'edu_date' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'edu_university' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'edu_title' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'edu_date' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'edu_university' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'edu_title' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'specialist' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'services' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'city_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]

        , 'date' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'address' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'address1' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'address2' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'insurance' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'field_name' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'from' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'table_name' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'priority' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'to' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'contact_us_title' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'contact_us' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'merchant_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'tags' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'url' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'degree' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ], 'part' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]
        , 'user' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
        ]
        ,
        'cylinder_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'max_percent' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'min' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'max' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'type_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'percent' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'body_installment' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'body_installment_date' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'body_installments_count' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'body_prepayment' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'power_level' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'third_installment' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'third_prepayment' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'third_installments_count' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'third_installment_date' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ],
        'branches' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ],
        'consent_price' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'response_time' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'fire_base' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'brick_structure_base' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'fire_base_year_min_20' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'fire_base_year_max_20' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ],
        'blood_money' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ], 'basic_financial' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ],


        'username' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ],


        'roles' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'نام کاربری حداقل 4 حرف باشد',
            'max' => 'نام کاربری حداکثر 191 حرف باشد',
            'unique' => 'این نام کاربری موجود است'
        ],
        'password' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'کلمه عبور حداقل 4 حرف باشد',
            'max' => 'کلمه عبور حداکثر 191 حرف باشد',
            'confirmed' => 'تایید کلمه عبور اجباری است'
        ],
        'email' => [
            'email' => 'پست الکترونیکی را بدرستی وارد کنید',
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'پست الکترونیکی حداقل 6 حرف باشد',
            'max' => 'پست الکترونیکی حداکثر 191 حرف باشد',
        ],
        'name' => [
            'max' => 'این فیلد حداکثر 191 حرف باشد',
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'این فیلد حداقل 4 حرف باشد',
            'regex' => 'نام را بدرستی وارد کنید'
        ], 'display_name' => [
            'max' => 'این فیلد حداکثر 191 حرف باشد',
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'این فیلد حداقل 4 حرف باشد',
            'regex' => 'نام را بدرستی وارد کنید'
        ],
        'guard_name' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'این فیلد حداقل 4 حرف باشد',
            'max' => 'این فیلد حداکثر 191 حرف باشد'
        ],
        'family' => [
            'max' => 'نام خانوادگی حداکثر 191 حرف باشد',
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'این فیلد حداقل 4 حرف باشد'
        ],
        'father_name' => [
            'max' => 'نام پدر حداکثر 191 حرف باشد'
        ],
        'national_code' => [
            'max' => 'کد ملی حداکثر 191 حرف باشد',
            'required' => 'تکمیل این فیلد اجباری است',
            'digits' => 'کدملی باید 10 رقمی باشد',
        ],
        'home_phone' => [
            'max' => 'تلفن منزل حداکثر 191 حرف باشد'
        ],
        'work_phone' => [
            'max' => 'تلفن محل کار حداکثر 191 حرف باشد'
        ],
        'major' => [
            'max' => 'رشته تحصیلی کار حداکثر 191 حرف باشد'
        ],
        'mobile' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'digits' => 'تلفن باید 11 رقمی باشد',
            'number' => 'تلفن باید عدد باشد',
        ],
        'day' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'integer' => 'این فیلد باید با عدد تکمیل شود',
            'digits' => 'این فیلد نمیتواند بیشتر از 3 رقم باشد',
        ],
        'price' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'integer' => 'این فیلد باید با عدد تکمیل شود',
            'digits' => 'این فیلد نمیتواند بیشتر از 8 رقم باشد',
        ],
        'fulltime_price' => [
            'numeric' => 'این فیلد باید با عدد تکمیل شود',

            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'number_category' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'integer' => 'این فیلد باید با عدد تکمیل شود',
            'digits' => 'این فیلد نمیتواند بیشتر از 2 رقم باشد',
        ],
        'question' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'answer' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'about' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'version' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'active' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'required' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'rule' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'users' => [
            'integer' => 'این فیلد باید با عدد تکمیل شود',
        ],
        'specialists' => [
            'integer' => 'این فیلد باید با عدد تکمیل شود',
        ],
        'visits' => [
            'integer' => 'این فیلد باید با عدد تکمیل شود',
        ],
        'title' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'min' => 'این فیلد حداقل 3 حرف باشد',
            'max' => 'این فیلد حداکثر 191 حرف باشد',
        ],
        'description' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'main_page_text' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'ads_page_text' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],

        'discount_price' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'integer' => 'این فیلد باید با عدد تکمیل شود',
            'digits' => 'این فیلد نمیتواند بیشتر از 8 رقم باشد',
        ],
        'count' => [
            'required' => 'تکمیل این فیلد اجباری است',
            'integer' => 'این فیلد باید با عدد تکمیل شود',
            'digits' => 'این فیلد نمیتواند بیشتر از 8 رقم باشد',
        ],
        'unit_name' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'unit_value' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'detail' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'category_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'brand_id' => [
            'required' => 'تکمیل این فیلد اجباری است',
        ],
        'sender_email' => [
            'email' => 'ایمیل معتبر نمیباشد'
        ],
        'message' => [
            'required' => 'تکمیل فیلد پیام اجباری است',
        ],
        'sender_name' => [
            'required' => 'تکمیل فیلد نام اجباری است',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'username' => 'نام کاربری',
        'email' => 'پست الکترونیکی'
    ],

];
