<?php

namespace Modules\People\Entities;

use App\Traits\MetadataTrait;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Addressable;
use App\Traits\CompanyTrait;
use Modules\Security\Contracts\SecureInterface;
use App\Traits\Contactable;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model implements SecureInterface
{
    use Uuid,
        Contactable,
        Addressable,
        SoftDeletes,
        MetadataTrait,
        CompanyTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    const STATUS_ACTIVE = 'active',
        STATUS_SUSPENDED = 'suspended';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'account_status',
        'user_id'
    ];

    protected $appends = [
        'full_name'
    ];

    /**
     * Returns the user attached to this person
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return preg_replace('/\s+/', ' ', "{$this->title} {$this->firstname} {$this->middlename} {$this->lastname}");
    }

    public function getGroupsAttribute()
    {
        return $this->user->groups;
    }

    public function families()
    {
        return $this->hasMany(FamilyMember::class)->with('family');
    }

    public function relationships()
    {
        return $this->hasMany(PersonRelationship::class)->with('relation');
    }

    public function fathers()
    {
        return $this->getPersonRelationshipByRoles([PersonRelationship::ROLE_FATHER]);
    }

    public function mothers()
    {
        return $this->getPersonRelationshipByRoles([PersonRelationship::ROLE_MOTHER]);
    }

    public function sisters()
    {
        return $this->getPersonRelationshipByRoles([PersonRelationship::ROLE_SISTER]);
    }

    public function brothers()
    {
        return $this->getPersonRelationshipByRoles([PersonRelationship::ROLE_SISTER]);
    }

    public function cousines()
    {

        return $this->getPersonRelationshipByRoles([PersonRelationship::ROLE_COUSIN]);
    }

    public function adults()
    {
        return $this->getPersonRelationshipByRoles([
            PersonRelationship::ROLE_FATHER,
            PersonRelationship::ROLE_MOTHER,
            PersonRelationship::ROLE_GUARDIAN,
            PersonRelationship::ROLE_GRAND_FATHER,
            PersonRelationship::ROLE_GRAND_MOTHER,
            PersonRelationship::ROLE_STEP_GRAND_FATHER,
            PersonRelationship::ROLE_STEP_GRAND_MOTHER
        ]);
    }

    public function getPersonRelationshipByRoles(array $roles)
    {
        return $this->relationships()->whereIn('relation_role', $roles);
    }
    public function addRelationship($person, string $role, string $inverseRole, bool $inverse = true)
    {
        if (!$this->id) {
            $this->save();
        }

        $person = (is_object($person)) ? $person : Person::findOrFail($person);

        $relation = $this->relationships()->withTrashed()->where('relation_id', $person->id)->first();

        if ($relation) {
            $relation->role = $role;
            $relation->relation_role = $inverseRole;
            $relation->restore();
        } else {
            $relation = new PersonRelationship(['role' => $role]);
            $relation->relation_role = $inverseRole;
            $relation->person()->associate($this);
            $relation->relation()->associate($person);
            $relation->save();
        }

        if ($inverse) {
            $person->addRelationship($this, $inverseRole, $role, false);
        }

        return $relation;
    }

    public function removeRelationship($person): self
    {
        if ($this->id) {
            $person = (is_object($person)) ? $person : Person::findOrFail($person);
            $relation = $this->relationships()->where('relation_id', $person->id)->first();
            if ($relation) {
                $relation->delete();
                $person->removeRelationship($this);
            }
        }

        return $this;
    }

    public function addToFamily($family, string $role): FamilyMember
    {
        if (!$this->id) {
            $this->save();
        }

        $family = (is_object($family)) ? $family : Family::findOrFail($family);

        $existingRecord = $this->families()->withTrashed()->where('family_id', $family->id)->first();
        if ($existingRecord) {
            $existingRecord->role = $role;
            $existingRecord->restore();

            return $existingRecord;
        } else {
            $member = new FamilyMember(['role' => $role]);
            $member->family()->associate($family);
            $member->person()->associate($this);
            $member->save();

            return $member;
        }
    }

    public function removeFromFamily($family): self
    {
        if ($this->id) {
            $family = (is_object($family)) ? $family : Family::findOrFail($family);
            $existingRecord = $this->families()->where('family_id', $family->id)->first();
            if ($existingRecord) {
                $existingRecord->delete();
            }
        }

        return $this;
    }

    public function hasAvatar(): bool
    {
        return ($this->getMetadataByName('has_avatar', 0) > 0);
    }

    public function setHasAvatar(bool $has): self
    {
        return $this->setMetadata('has_avatar', ($has) ? 1: 0);
    }

    public static function getHumanDescription(): string
    {
        return 'Person generic information';
    }

   public function __get($key)
    {

        if ($this->isMetadataKey($key)) {
            return $this->getMetadataByName($key);
        } else {
            return parent::__get($key);
        }
    }

   public function __set($key, $value)
    {

        if ($this->isMetadataKey($key)) {
            return $this->setMetadata($key, $value);
        } else {
            return parent::__set($key, $value);
        }
    }

    public static function getHumanName(): string
    {
        return 'Person';
    }
}
