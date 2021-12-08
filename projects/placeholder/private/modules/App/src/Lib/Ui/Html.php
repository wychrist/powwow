<?php

namespace App\Lib\Ui;

/**
 * Description of Html
 *
 * @author unleash
 */
class Html
{

    protected $voidElements = [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'link',
        'meta',
        'param',
        'source',
        'track',
        'wbr'
    ];
    protected $tag;
    protected $isVoidTag = false;
    protected $property = [];
    protected $children = [];
    protected $metadata = [];
    protected $parent;
    protected $callbacks = [
        'before_render' => [],
        'after_render' => []
    ];
    public $text = '';

    /**
     * Construct a new node
     *
     * @param string $tag the node tag
     * @param string $id the id for the node
     */
    public function __construct($tag = false, $id = false)
    {
        $nodeId = ($id) ? $id : uniqid('ele_');
        $this->setTag($tag);
        $this->set('id', $nodeId);
    }

    /**
     * Set the tag for this node
     *
     * @param string $tag HTML tag
     * @return $this
     */
    public function setTag($tag)
    {
        $tag = strtolower(trim($tag));
        if (in_array($tag, $this->voidElements)) {
            $this->isVoidTag = true;
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get the tag for this node
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set an attribute or property on this node
     *
     * @param string $property name
     * @param string $value value
     * @return $this
     */
    public function set($property, $value = null)
    {
        $property = trim(strtolower($property));
        $oldId = $this->get('id');

        if (isset($this->property[$property])) {
            if ($property == 'class') {
                $this->addClass($value);
            } else {
                $this->property[$property] = $value;
            }
        } else if ($property == 'class') {
            $this->addClass($value);
        } else {
            $this->property[$property] = $value;
        }

        if ($property == 'id' && $this->parent) {
            $this->parent->replace($oldId, $this);
        }

        return $this;
    }

    /**
     * Returns the value for the property or attribute specified
     *
     * @param string $property
     * @return mixed
     */
    public function get($property)
    {
        $property = trim(strtolower($property));

        return (isset($this->property[$property])) ? $this->property[$property] : null;
    }

    /**
     * Append  a value to the current property value
     *
     * @param string $property The property name
     * @param string $value The value to append
     * @return $this
     */
    public function appendValue($property, $value = null)
    {
        $property = trim(strtolower($property));

        if (isset($this->property[$property])) {
            if ($property == 'class') {
                $this->addClass($value);
            } else {
                $this->property[$property] .= $value;
            }
        } else {
            $this->set($property, $value);
        }

        return $this;
    }

    /**
     * Set a meta attribute value
     *
     * @param string $name meta name
     * @param string $value
     * @return $this
     */
    public function setMeta($name, $value = null)
    {
        $this->metadata[$name] = $value;
        return $this;
    }

    /**
     * Return the value for the meta specified
     *
     * @param string $name
     * @return mixed
     */
    public function getMeta($name)
    {
        return (isset($this->metadata[$name])) ? $this->metadata[$name] : null;
    }

    /**
     * Add a class to this node
     *
     * @param string $class
     * @return $this
     */
    public function addClass($class)
    {

        if (!isset($this->property['class'])) {
            $this->property['class'] = [];
        }

        $this->property['class'][trim(strtolower($class))] = $class;

        return $this;
    }

    /**
     * Check if this element has a class
     *
     * @param string $class class to check for
     * @return boolean
     */
    public function hasClass($class)
    {
        $class = trim(strtolower($class));
        return isset($this->property['class'][trim(strtolower($class))]);
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Remove the specified class from the element
     *
     * @param string $class
     * @return $this
     */
    public function removeClass($class)
    {
        $class = trim(strtolower($class));

        if (isset($this->property['class']) && isset($this->property['class'][$class])) {
            unset($this->property['class'][$class]);
        }

        return $this;
    }

    /**
     *  Add a content to this element
     *
     * @param string | object $content  A node or a string
     * @param string $before The id of the element to placed before
     * @param string $after The id of the element to be placed after
     * @return $this
     */
    public function addContent($content, $before = false, $after = false)
    {
        if (is_object($content)) {
            $this->addNode($content, $before, $after);
        } else {
            $node = new Html('', uniqid('text'));
            $node->text = $content;
            $this->addNode($node, $before, $after);
        }
        return $this;
    }

    /**
     *
     * @param string | object $content  A node or a string
     * @return $this
     */
    public function setContent($content)
    {
        $this->children = [];
        return $this->addContent($content);
    }

    /**
     * Add a node as a child to this element
     *
     * @param string $tag tag name
     * @param string $id id attribute
     * @param string $before id of the element this element should be inserted before
     * @param string $after id of the element this element should be inserted after
     * @return \App\Lib\Ui\Html The new node
     */
    public function add($tag, $id = false, $before = false, $after = false)
    {
        $id = ($id) ? $id : uniqid($tag);
        $node = new Html($tag, $id);
        return $this->addNode($node, $before, $after);
    }

    /**
     * Add a node before the specified node
     *
     * @param string $tag new node tag
     * @param string $before id of the element this element should be inserted before
     * @return \App\Lib\Ui\Html The new node
     */
    public function addBefore($tag, $before)
    {
        return $this->add($tag, $before);
    }

    /**
     * Add a node after the specified node
     *
     * @param string $tag new node tag
     * @param string $after id of the element this element should be inserted fater
     * @return \App\Lib\Ui\Html The new node
     */
    public function addAfter($tag, $after)
    {
        return $this->add($tag, false, $after);
    }

    /**
     * Removes the specified node
     *
     * @param string | object $idOrObj ID for the node or the node object
     * @return $this
     */
    public function remove($idOrObj)
    {
        $id = (is_object($idOrObj)) ? $idOrObj->get('id') : $idOrObj;
        if (isset($this->children[$id])) {
            unset($this->children[$id]);
        }

        return $this;
    }

    /**
     * Replace a child node of this node with the new node specified
     *
     * @param string | object $idObjectToReplace the ID or the object of the node to replace
     * @param \App\Lib\Ui\Html $withObj The node that will be replacing this node
     * @return $this
     */
    public function replace($idObjectToReplace, Html $withObj)
    {
        $replaceId = (is_object($idObjectToReplace)) ? $idObjectToReplace->get('id') : $idObjectToReplace;

        if (isset($this->children[$withObj->get('id')])) {
            unset($this->children[$withObj->get('id')]);
        }

        $withArray = [];

        foreach ($this->children as $key => $value) {

            if ($key == $replaceId) {
                $withArray[$withObj->get('id')] = $withObj;
                continue;
            }

            $withArray[$key] = $value;
        }

        $this->children = $withArray;
        $withArray = null;

        return $this;
    }

    /**
     * Checks if this node has the specified node as it child
     * @param string | object $idOrObj The Id or the object of the node to check for
     * @return boolean
     */
    public function has($idOrObj): bool
    {
        $id = (is_object($idOrObj)) ? $idOrObj->getId() : $idOrObj;

        return isset($this->children[$id]);
    }

    /**
     * Add a node as a child to this node
     *
     * @param \App\Lib\Ui\Html $node new node
     * @param string $before id of the node this new node will be inserted before
     * @param string $after id of the node this new node will be inserted after
     * @return \App\Lib\Ui\Html
     */
    public function addNode(Html $node, $before = false, $after = false)
    {
        if ($before) {
            $beforeArray = [];

            foreach ($this->children as $key => $value) {
                if ($key == trim($before)) {
                    $beforeArray[$node->get('id')] = $node;
                }

                if (!isset($beforeArray[$key]) && $key != $node->get('id')) {
                    $beforeArray[$key] = $value;
                }
            }

            $this->children = $beforeArray;
            $beforeArray = null;
        }

        if ($after) {
            $afterArray = [];
            foreach ($this->children as $key => $value) {

                if (!isset($afterArray[$key]) && $key != $node->get('id')) {
                    $afterArray[$key] = $value;
                }

                if ($key == trim($after)) {
                    $afterArray[$node->get('id')] = $node;
                }
            }

            $this->children = $afterArray;
            $afterArray = null;
        }

        if (!$before && !$after) {
            $this->children[$node->get('id')] = $node;
        }

        foreach ($this->callbacks['before_render'] as $callback) {
            $node->beforeRender($callback);
        }

        foreach ($this->callbacks['after_render'] as $callback) {
            $node->afterRender($callback);
        }

        $node->parent = $this;
        return $node;
    }

    /**
     * Add a node before another node
     *
     * @param \App\Lib\Ui\Html $node
     * @param string $before id of the node
     * @return \App\Lib\Ui\Html
     */
    public function addNodeBefore(Html $node, $before)
    {
        return $this->addNode($node, $before);
    }

    /**
     * Add a node after another node
     *
     * @param \App\Lib\Ui\Html $node
     * @param string $after node id
     * @return \App\Lib\Ui\Html
     */
    public function addNoteAfter(Html $node, $after)
    {
        return $this->addNode($node, false, $after);
    }

    /**
     * Return the node for the id specified
     *
     * @param string $id
     * @return flase | \App\Lib\Ui\Html
     */
    public function getNode($id): ? Html
    {
        return (isset($this->children[$id])) ? $this->children[$id] : null;
    }

    /**
     * Returns the parent node for this node
     *
     * @return null | \App\Lib\Ui\Html
     */
    public function getParent():? Html
    {
        return $this->parent;
    }

    /**
     * Returns the children of this node
     *
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Returns an array representation of this node
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        $data['tag'] = $this->tag;
        $data['isVoidTag'] = $this->isVoidTag;
        $data['property'] = $this->property;
        $data['metadata'] = $this->metadata;
        $data['text'] = $this->text;
        $data['children'] = [];

        foreach ($this->children as $key => $value) {
            if (is_object($value)) {
                $data['children'][$key] = $value->toArray();
            } else {
                $data['children'][$key] = $value;
            }
        }

        return $data;
    }

    /**
     * Generate this node from an array
     *
     * @param array $array
     * @return $this
     */
    public function fromArray(array $array): Html
    {
        $this->tag = $array['tag'];
        $this->isVoidTag = $array['isVoidTag'];
        $this->metadata = $array['metadata'];
        $this->text = $array['text'];

        foreach($array['property'] as $key => $value){
            $this->set($key,$value);
        }

        foreach($array['metadata'] as $key => $value){
            $this->setMeta($key,$value);
        }

        foreach($array['children'] as $key => $value){
            if(is_array($value)){
                $temp = new Html();
                $temp->fromArray($value);
            }else{
                $temp = $value;
            }

            $this->children[$key] = $temp;
        }

        return $this;
    }

    /**
     * Register a callback to call before the render function is called
     *
     * @param callable $callback
     */
    public function beforeRender($callback)
    {

        $this->callbacks['before_render'][] = $callback;

        foreach ($this->children as $child) {
            if (is_object($child)) {
                $child->beforeRender($callback);
            }
        }
    }

    public function afterRender($callback)
    {

        $this->callbacks['after_render'][] = $callback;

        foreach ($this->children as $child) {
            if (is_object($child)) {
                $child->afterRender($callback);
            }
        }
    }

    /**
     * Generate the HTML string for this node
     * 
     * @return string
     */
    public function render()
    {

        $html = '';

        foreach ($this->callbacks['before_render'] as $callback) {
            call_user_func_array($callback, [$this]);
        }

        if ($this->tag) {
            $html .= '<' . $this->tag;

            foreach ($this->property as $key => $value) {
                if ($key != 'class') {
                    if ($value !== null) {
                        $value = str_replace('"', '\'', $value);
                        $html .= ' ' . $key . '="' . $value . '"';
                    } else {
                        $html .= ' ' . $key;
                    }
                } else {
                    $classes = implode(' ', $this->property['class']);
                    $html .= ' ' . $key . '="' . $classes . '"';
                }
            }
        }

        if ($this->isVoidTag && $this->tag) {
            $html .= ' />';
        } else {
            if ($this->tag) {
                $html .= '>';
            }


            foreach ($this->children as $value) {
                if (is_object($value)) {
                    $html .= $value->render();
                } else {
                    $html .= $value;
                }
            }

            $html .= $this->text;


            if ($this->tag) {
                $html .= '</' . $this->tag . '>';
            }
        }

        foreach ($this->callbacks['after_render'] as $callback) {
            call_user_func_array($callback, [$this, $html]);
        }

        return $html;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        } elseif (isset($this->property[$name])) {
            return $this->property[$name];
        } elseif (isset($this->metadata[$name])) {
            return $this->metadata[$name];
        } else if (isset($this->children[$name])) {
            return $this->children[$name];
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        } elseif (isset($this->property[$name])) {
            $this->set($name, $value);
        } elseif (isset($this->metadata[$name])) {
            $this->setMeta($name, $value);
        } else if (isset($this->children[$name])) {
            $this->children[$name] = $value;
        } else {
            $this->{$name} = $value;
        }
    }

    public function __toString()
    {
        return $this->render();
    }

}
