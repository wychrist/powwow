<?php

use App\Entity\Elder;

$elders = [
  [
    'name' => 'Bill Dusza',
    'image' => '/assets/img/bill.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'Elder, President',
  ],

  [
    'name' => 'Kerron Martin',
    'image' => '/assets/img/kerron.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'Elder',
  ],
];

foreach ($elders as $index => $data) {
  $elders[$index] = new Elder($data);
}
return $elders;
