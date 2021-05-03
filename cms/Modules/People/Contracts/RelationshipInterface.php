<?php

namespace Modules\People\Contracts;

interface RelationshipInterface
{
    const ROLE_FATHER = 'father',
        ROLE_MOTHER = 'mother',
        ROLE_STEP_FATHER = 'step_father',
        ROLE_STEP_MOTHER = 'step_mother',
        ROLE_GRAND_FATHER = 'grand_father',
        ROLE_GRAND_MOTHER = 'grand_mother',
        ROLE_STEP_GRAND_FATHER = 'step_grand_father',
        ROLE_STEP_GRAND_MOTHER = 'step_grand_mother',
        ROLE_UNCLE = 'uncle',
        ROLE_AUNTY = 'aunty',
        ROLE_SON = 'son',
        ROLE_STEP_SON = 'son',
        ROLE_DAUGHTER = 'daughter',
        ROLE_STEP_DAUGHTER = 'step_daughter',
        ROLE_CHILD = 'child',
        ROLE_STEP_CHILD = 'step_child',
        ROLE_SISTER = 'sister',
        ROLE_STEP_SISTER = 'sister',
        ROLE_HALF_SISTER = 'sister',
        ROLE_BROTHER = 'brother',
        ROLE_STEP_BROTHER = 'brother',
        ROLE_HALF_BROTHER = 'brother',
        ROLE_NIECE = 'niece',
        ROLE_NEPHEW = 'nephew',
        ROLE_GUARDIAN = 'guardian',
        ROLE_COUSIN = 'cousine';

    const STATUS_ACTIVE = 'active',
        STATUS_INACTIVE = 'inactive';
}
