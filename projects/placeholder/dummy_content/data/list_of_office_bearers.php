<?php

use App\Entity\Elder;

$people = [
  [
    'name' => 'Bill Dusza',
    'image' => '/assets/img/bill.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'President, Elder',
  ],

  [
    'name' => 'Micah',
    'image' => '/assets/img/kerron.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'Treasure',
  ],
  [
    'name' => 'Chris',
    'image' => '/assets/img/kerron.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'Secretary',
  ],
];

foreach ($people as $index => $data) {
  $people[$index] = new Elder($data);
}
return $people;
