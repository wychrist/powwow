<?php

namespace App\Traits;

use App\Models\Metadata;
use Closure;

trait MetadataTrait
{
    private $_metadata = null;

    public static function bootMetadataTrait()
    {
        static::saved(function ($model) {
            $model->saveMetadata();
        });
    }

    public static function initializeMetadataTrait()
    {
        // nothing here yet
    }

    /*
     This should be in a helper class
    public function whenMetadataTypeIs(string $name, string $type, Closure $callback, &$result): self
    {
        $metatadata = $this->getMetadataObject($name);

        if($metatadata  && $metatadata->value_type == $type) {
            $result =  $callback($this->metadata(), $metatadata);
        }

        return $this;
    }*/

    public function metadata()
    {
        return $this->hasMany(Metadata::class, 'metadata_id')
            ->where('metadata_type', get_class($this))
            ->whereHas('companies', function($query) {
                $query->where('id', company()->id);
            })->orDoesntHave('companies');
    }

    public function getMetadataByName(string $name, $default = null)
    {
        $this->prepMetadata();
        $name = $this->prepMetadataName($name);
        $value = $default;

        if (isset($this->_metadata[$name])) {
            switch ($this->_metadata[$name]['object']->value_type) {
                case Metadata::TYPE_INT:
                    $value =  $this->_metadata[$name]['object']->int_value;
                    break;
                case Metadata::TYPE_FLOAT:
                    $value = $this->_metadata[$name]['object']->float_value;
                    break;
                default:
                    $value = $this->_metadata[$name]['object']->text_value;
            }
        }

        $metadataGetter = 'getMetadata' . ucfirst($name); // foo => getMetadataFoo
        if (method_exists($metadataGetter, $this)) {
            return $this->{$metadataGetter}($value, $this->getMetadataObject($name));
        } else {
            return $value;
        }
    }

    /**
     * Set int value for the specified metadata key
     *
     * @param string $name
     * @param int value
     * @param bool $companyUnique This value is specific to the current compoany
     *
     * @return self
     */
    public function setMetadataInt(string $name, int $value, bool $companyUnique = false): self
    {
        return $this->setMetadata($name, $value, Metadata::TYPE_INT, $companyUnique);
    }

    /**
     * Set float value for the specified metadata key
     *
     * @param string $name
     * @param float value
     * @param bool $companyUnique This value is specific to the current compoany
     *
     * @return self
     */
    public function setMetadataFloat(string $name, float $value, bool $companyUnique = false): self
    {
        return $this->setMetadata($name, $value, Metadata::TYPE_FLOAT, $companyUnique);
    }

    /**
     * Set string value for the specified metadata key
     *
     * @param string $name
     * @param string value
     * @param bool $companyUnique This value is specific to the current compoany
     *
     * @return self
     */
    public function setMetadataText(string $name, string $value, bool $companyUnique = false): self
    {
        return $this->setMetadata($name, $value, Metadata::TYPE_TEXT, $companyUnique);
    }

    /**
     * Set a value for a metadata key
     *
     * @param string $name
     * @param int|float|string $value
     * @param string $type [null | Metadata::TYPE_INT | Metadata::TYPE_FLOAT | Metadata::TYPE_TEXT]
     * @param bool $companyUnique This value is specific to the current compoany
     *
     * @return self
     */
    public function setMetadata(string $name, $value, string $type = null, bool $companyUnique = false): self
    {
        $name  = $this->prepMetadataName($name);
        $metadata = $this->getMetadataObject($name);
        $isDirty = false;

        if (!$metadata) {
            $metadata = new Metadata([
                'name' => $name,
                'metadata_type' => get_class($this),
                'metadata_id' => $this->id,
            ]);
            $isDirty = true;
        }
        if ($type == null) {
            if (is_numeric($value)) {
                if (strstr($value, '.') == false) {
                    $type = Metadata::TYPE_INT;
                } elseif (is_float(floatval($value))) {
                    $type = Metadata::TYPE_FLOAT;
                }
            } else {
                $type = Metadata::TYPE_TEXT;
            }
        }

        $metdataSetter = 'setMetadata' . ucfirst($name);
        if (method_exists($metdataSetter, $this)) {
            $value = $this->{$metdataSetter}($value, $metadata);
        }

        $isDirty = $metadata->value != $value;

        switch ($type) {
            case Metadata::TYPE_INT:
                $metadata->int_value = $value;
                $metadata->text_value = null;
                $metadata->float_value = null;
                $metadata->value_type = Metadata::TYPE_INT;
                break;
            case Metadata::TYPE_FLOAT:
                $metadata->float_value = $value;
                $metadata->int_value = null;
                $metadata->text_value = null;
                $metadata->value_type = Metadata::TYPE_FLOAT;
                break;
            default: // default is Metadata::TYPE_TEXT
                $metadata->text_value = $value;
                $metadata->int_value = null;
                $metadata->float_value = null;
                $metadata->value_type = Metadata::TYPE_TEXT;
        }

        $this->_metadata[$name] = [
            'is_dirty' => $isDirty,
            'is_deleted' => false,
            'company_unique' => $companyUnique,
            'object' => $metadata
        ];

        return $this;
    }

    public function setMetadataBatch(array $keysValues, bool $companyUnique = false): self
    {
        foreach ($keysValues as $name => $value) {
            $this->setMetadata($name, $value, null, $companyUnique);
        }
        return $this;
    }

    public function getMetadataAsKeyValue()
    {
        $this->prepMetadata();

        $colletion = [];
        foreach ($this->_metadata as $name => $_) {
            $colletion[$name] = $this->getMetadataByName($name);
        }
        return $colletion;
    }

    public function getMetadataObjectByName($name): ?Metadata
    {
        $this->prepMetadata();
        $name = $this->prepMetadataName($name);

        return (isset($this->_metadata[$name])) ? $this->_metadata[$name]['object'] : null;
    }

    public function getMetadataObjects(): array
    {
        $collection = [];
        $this->prepMetadata();

        foreach ($this->_metadata as $info) {
            $collection[] = $info['object'];
        }

        return $collection;
    }

    public function deleteMetadata(string $name)
    {
        $this->prepMetadata();
        $name = $this->prepMetadataName($name);

        if (isset($this->_metadata[$name])) {
            $this->_metadata[$name]['is_deleted'] = true;
        }

        return null;
    }

    public function saveMetadata()
    {
        if (is_array($this->_metadata)) {
            foreach ($this->_metadata as $info) {
                if ($info['is_dirty']) {
                    $info['object']->metadata_id = $this->id;
                    $info['object']->save();
                    if($info['company_unique']) {
                        $info['object']->companies()->syncWithoutDetaching(company());
                    }
                }

                if ($info['is_deleted']) {
                    $info['object']->delete();
                }
            }
        }
    }

    private function prepMetadata()
    {
        if ($this->_metadata === null) {
            $this->_metadata = [];
            if ($this->metadata) {
                $this->metadata->each(function ($metadata) {
                    $this->_metadata[$metadata->name] = [
                        'is_dirty' => false,
                        'is_deleted' => false,
                        'object' => $metadata
                    ];
                });
            }
        }
    }

    private function getMetadataObject(string $name): ?Metadata
    {
        $this->prepMetadata();
        $name = $this->prepMetadataName($name);

        return (isset($this->_metadata[$name])) ? $this->_metadata[$name]['object'] : null;
    }


    private function prepMetadataName(string $name): string
    {
        return str_replace('meta_', '', strtolower(trim(implode('', explode(' ', $name)))));
    }

    private function isMetadataKey($key)
    {
        return (strpos($key, 'meta_') === 0);
    }
}
