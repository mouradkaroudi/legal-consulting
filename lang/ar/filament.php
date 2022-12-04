<?php

return [
	"actions" => [
		"accept" => [
			"single" => [
				"label" => "موافقة",

				"modal" => [
					"heading" => "موافقة :label",

					"fields" => [
						"record_id" => [
							"label" => "السجلات",
						],
					],

					"actions" => [
						"accept" => [
							"label" => "وافق",
						],
					],
				],

				"messages" => [
					"accepted" => "تم الموافقة",
				],
			],
		],
        "refuse" => [
			"single" => [
				"label" => "رفض",

				"modal" => [
					"heading" => "رفض :label",

					"fields" => [
						"record_id" => [
							"label" => "السجلات",
						],
					],

					"actions" => [
						"accept" => [
							"label" => "ارفض",
						],
					],
				],

				"messages" => [
					"accepted" => "تم الرفض",
				],
			],
		],
	],
];
