<?php

return [
    'transactions' => [
        'accepted' => [
            'title' => 'congratulations! Your transaction processed',
            'body' => 'transaction number :txn_id has been accepted successfully. :amount has been added to your account balance'
        ],
        'refused' => [
            'title' => 'Sorry! Your transaction refused',
            'body' => 'transaction number :txn_id has been refused. :body'
        ]
    ]
];