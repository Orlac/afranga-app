<?php

namespace App\Dto;

final readonly class ClientsExportDto extends BaseDto
{
    public function __construct(
        public ?int    $id = null,
        public ?int    $pass_id = null,
        public ?int    $phone = null,
        public ?string $name = null,
        public ?string $mail = null,
    )
    {

    }
}
