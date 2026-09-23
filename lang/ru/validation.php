<?php

return [
    'accepted' => 'Поле :attribute должно быть принято.',
    'accepted_if' => 'Поле :attribute должно быть принято, когда :other имеет значение :value.',
    'active_url' => 'Поле :attribute должно быть корректным URL-адресом.',
    'after' => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal' => 'Поле :attribute должно быть датой после или равной :date.',
    'alpha' => 'Поле :attribute должно содержать только буквы.',
    'alpha_dash' => 'Поле :attribute должно содержать только буквы, цифры, дефисы и знаки подчёркивания.',
    'alpha_num' => 'Поле :attribute должно содержать только буквы и цифры.',
    'any_of' => 'Поле :attribute содержит некорректное значение.',
    'array' => 'Поле :attribute должно быть массивом.',
    'ascii' => 'Поле :attribute должно содержать только однобайтовые буквенно-цифровые символы.',
    'before' => 'Поле :attribute должно быть датой до :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой до или равной :date.',
    'between' => [
        'array' => 'Поле :attribute должно иметь между :min и :max элементов.',
        'file' => 'Поле :attribute должно иметь между :min и :max килобайтов.',
        'numeric' => 'Поле :attribute должно иметь значение между :min и :max.',
        'string' => 'Поле :attribute должно иметь между :min и :max символов.',
    ],
    'boolean' => 'Поле :attribute должно быть логического типа (true или false).',
    'can' => 'Поле :attribute содержит несанкционированное значение.',
    'confirmed' => 'Подтверждение поля :attribute не совпадает.',
    'contains' => 'Поле :attribute не содержит обязательное значение.',
    'current_password' => 'Пароль некорректен.',
    'date' => 'Поле :attribute должно быть корректной датой.',
    'date_equals' => 'Поле :attribute должно быть датой, совпадающей с :date.',
    'date_format' => 'Поле :attribute должно быть формата :format.',
    'decimal' => 'Поле :attribute должно иметь :decimal знаков после запятой.',
    'declined' => 'Поле :attribute должно быть отклонено.',
    'declined_if' => 'Поле :attribute должно быть отклонено, когда :other имеет значение :value.',
    'different' => 'Поля :attribute и :other должны различаться значениями.',
    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать между :min и :max цифр.',
    'dimensions' => 'Поле :attribute содержит недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute имеет дублированное значение.',
    'doesnt_contain' => 'Поле :attribute не должно содержать ничего из следующего: :values.',
    'doesnt_end_with' => 'Поле :attribute не должно заканчиваться на что-либо из следующего: :values.',
    'doesnt_start_with' => 'Поле :attribute не должно начинаться на что-либо из следующего: :values.',
    'email' => 'Поле :attribute должно быть правильным электронным почтовым адресом.',
    'encoding' => 'Поле :attribute должно быть в кодировке :encoding.',
    'ends_with' => 'Поле :attribute должно заканчиваться на что-либо из следующего: :value.',
    'enum' => 'Выбранное значение в поле :attribute некорректно.',
    'exists' => 'Выбранное значение для :attribute некорректно.',
    'extensions' => 'Поле :attribute должно иметь одно из следующих расширений: :values.',
    'file' => 'Значение для поля :attribute должно быть файлом.',
    'filled' => 'Поле :attribute обязательно для заполнения.',
    'gt' => [
        'array' => 'Поле :attribute должно иметь больше элементов, чем :value.',
        'file' => 'Поле :attribute должно иметь больше килобайтов, чем :value.',
        'numeric' => 'Значение поля :attribute должно быть больше, чем :value.',
        'string' => 'Поле :attribute должно иметь больше символов, чем :value.',
    ],
    'gte' => [
        'array' => 'Поле :attribute должно иметь :value элементов или больше.',
        'file' => 'Поле :attribute должно иметь больше :value килобайтов или столько же.',
        'numeric' => 'Значение поля :attribute должно быть больше или равным :value.',
        'string' => 'Поле :attribute должно иметь больше символов, чем :value, или столько же.',
    ],
    'hex_color' => 'Поле :attribute должно иметь корректный шестнадцатеричным (HEX) цветом.',
    'image' => 'Поле :attribute должно иметь изображение.',
    'in' => 'Выбранное значение поля :attribute некорректно.',
    'in_array' => 'Поле :attribute должно существовать в :other.',
    'in_array_keys' => 'Поле :attribute должно содержать как минимум одно из следующих ключей: :values.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть корректным IP-адресом.',
    'ipv4' => 'Поле :attribute должно быть корректным IPv4-адресом.',
    'ipv6' => 'Поле :attribute должно быть корректным IPv6-адресом.',
    'json' => 'Поле :attribute должно быть корректной JSON-строкой.',
    'list' => 'Поле :attribute должно быть списком.',
    'lowercase' => 'Поле :attribute должно быть в нижнем регистре.',
    'lt' => [
        'array' => 'Поле :attribute должно иметь меньше элементов, чем :value.',
        'file' => 'Поле :attribute должно иметь меньше килобайтов, чем :value.',
        'numeric' => 'Значение поля :attribute должно быть меньше, чем :value.',
        'string' => 'Поле :attribute должно содержать меньше символов, чем :value.',
    ],
    'lte' => [
        'array' => 'Поле :attribute должно содержать не больше элементов, чем :value.',
        'file' => 'Поле :attribute должно содержать меньше килобайтов, чем :value или столько же.',
        'numeric' => 'Значение поля :attribute должно быть меньше, чем :value или столько же.',
        'string' => 'Поле :attribute должно иметь меньше символов, чем :value, или столько же.',
    ],
    'mac_address' => 'Поле :attribute должно иметь корректный MAC-адрес.',
    'max' => [
        'array' => 'Поле :attribute должно содержать не больше :max элементов.',
        'file' => 'Поле :attribute должно иметь не больше килобайтов, чем :max.',
        'numeric' => 'Значение поля :attribute должно быть не больше :max.',
        'string' => 'Поле :attribute должно иметь не более :max символов.',
    ],
    'max_digits' => 'Поле :attribute должно иметь не больше цифр, чем :max.',
    'mimes' => 'Поле :attribute должно быть файлом типа: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом типа: :values.',
    'min' => [
        'array' => 'Поле :attribute должно иметь минимум :min элементов.',
        'file' => 'Поле :attribute должно иметь минимум :min килобайтов.',
        'numeric' => 'Значение поля :attribute должно быть минимум :min.',
        'string' => 'Поле :attribute должно иметь минимум :min символов.',
    ],
    'min_digits' => 'Поле :attribute должно содержать минимум :min цифр.',
    'missing' => 'Поле :attribute должно отсутствовать.',
    'missing_if' => 'Поле :attribute должно отсутствовать, когда :other имеет значение :value.',
    'missing_unless' => 'Поле :attribute должно отсутствовать, только если :other не имеет значение :value.',
    'missing_with' => 'Поле :attribute должно отсутствовать, когда присутствует :values.',
    'missing_with_all' => 'Поле :attribute должно отсутствовать, когда присутствуют :values.',
    'multiple_of' => 'Поле :attribute должно быть кратным :value.',
    'not_in' => 'Выбранное значение :attribute некорректно.',
    'not_regex' => 'Поле :attribute имеет некорректный формат.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => [
        'letters' => 'Поле :attribute должно содержать хотя бы одну букву.',
        'mixed' => 'Поле :attribute должно содержать хотя бы одну букву верхнего регистра и одну букву нижнего регистра.',
        'numbers' => 'Поле :attribute должно содержать хотя бы одну цифру.',
        'symbols' => 'Поле :attribute должно содержать хотя бы один символ.',
        'uncompromised' => 'Введённое значение :attribute было замечено в утечке данных. Пожалуйста, выберите другое значение :attribute.',
    ],
    'present' => 'Поле :attribute должно присутствовать.',
    'present_if' => 'Поле :attribute должно присутствовать, когда :other имеет значение :value.',
    'present_unless' => 'Поле :attribute должно присутствовать, только если :other не имеет :value.',
    'present_with' => 'Поле :attribute должно присутствовать, когда :values присутствует.',
    'present_with_all' => 'Поле :attribute должно присутствовать, когда :values присутствуют.',
    'prohibited' => 'Поле :attribute запрещено.',
    'prohibited_if' => 'Поле :attribute запрещено, когда :other имеет значение :value.',
    'prohibited_if_accepted' => 'Поле :attribute запрещено, когда :other принято.',
    'prohibited_if_declined' => 'Поле :attribute запрещено, когда :other отклонено.',
    'prohibited_unless' => 'Поле :attribute запрещено, только если :other не в :values.',
    'prohibits' => 'Поле :attribute запрещает присутствие :other.',
    'regex' => 'Формат поля :attribute некорректен.',
    'required' => 'Поле :attribute обязательно.',
    'required_array_keys' => 'Поле :attribute должно содержать значения для: :values.',
    'required_if' => 'Поле :attribute обязательно, когда :other имеет значение :value.',
    'required_if_accepted' => 'Поле :attribute обязательно, когда :other принято.',
    'required_if_declined' => 'Поле :attribute обязательно, когда :other отклонено.',
    'required_unless' => 'Поле :attribute обязательно, только если :other не в :values.',
    'required_with' => 'Поле :attribute обязательно, когда присутствует :values.',
    'required_with_all' => 'Поле :attribute обязательно, когда присутствуют :values.',
    'required_without' => 'Поле :attribute обязательно, когда не присутствует :values.',
    'required_without_all' => 'Поле :attribute обязательно, когда не присутствуют :values.',
    'same' => 'Поле :attribute должно совпадать с :other.',
    'size' => [
        'array' => 'Поле :attribute должно содержать :size элементов.',
        'file' => 'Поле :attribute должно иметь :size килобайтов.',
        'numeric' => 'Поле :attribute должно быть :size.',
        'string' => 'Поле :attribute должно иметь :size символов.',
    ],
    'starts_with' => 'Поле :attribute должно начинаться с чем-либо из следующего: :values.',
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть корректным временным поясом.',
    'unique' => 'Поле :attribute уже занято.',
    'uploaded' => 'Поле :attribute не удалось загрузить.',
    'uppercase' => 'Поле :attribute должно быть в верхнем регистре.',
    'url' => 'Поле :attribute должно быть корректным URL-адресом.',
    'ulid' => 'Поле :attribute должно быть корректным ULID.',
    'uuid' => 'Поле :attribute должно быть корректным UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
