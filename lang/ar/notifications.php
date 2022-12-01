<?php

return [
    'transactions' => [
        'accepted' => [
            'title' => 'تهانينا! تمت معالجة معاملتك',
            'body' => 'تم قبول المعاملة رقم :txn_id. تم إضافة مبلغ :amount الى رصيدك'
        ],
        'refused' => [
            'title' => 'نعتذر! تم رفض معاملتك',
            'body' => 'تم رفض المعاملة رقم :txn_id. :body'
        ]
    ]
];