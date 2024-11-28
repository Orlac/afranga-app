<?php

use App\Dto\ClientsExportDto;

/** @var ClientsExportDto $filterDto */

?>

<p><b>Id: </b> {{ $filterDto->id }}</p>
<p><b>Pass Id: </b> {{ $filterDto->pass_id }}</p>
<p><b>Name: </b> {{ $filterDto->name }}</p>
<p><b>Phone: </b> {{ $filterDto->phone }}</p>

