<?php

namespace CtrlAuth\Form\Role;

use \CtrlAuth\Domain;
use Ctrl\Form\Form;
use Zend\InputFilter\Factory as FilterFactory;
use Zend\InputFilter\InputFilter;
use Ctrl\Form\Element\Hidden as HiddenInput;
use Ctrl\Form\Element\Text as TextInput;
use Ctrl\Form\Element\Textarea as TextareaInput;
use Ctrl\Form\Element\Select as SelectInput;
use Ctrl\Form\Element\Checkbox as CheckboxInput;

class Edit extends \Ctrl\Form\Form
{
    const ELEM_NAME = 'name';
    const ELEM_SYSTEM = 'system';

    public function __construct($name = null)
    {
        parent::__construct('user-edit');

        $input = new TextInput(self::ELEM_NAME);
        $input->setLabel('name');
        $this->add($input);

        $input = new CheckboxInput(self::ELEM_SYSTEM);
        $input->setLabel('system role');
        $this->add($input);

        $this->setInputFilter($this->getInputFilter());
    }

    public function getInputFilter()
    {
        $factory = new FilterFactory();
        $filter = new InputFilter();
        $filter->add($factory->createInput(array(
            'name'     => self::ELEM_NAME,
            'required' => false,
        )));

        return $filter;
    }

    public function loadModel(\Ctrl\Domain\Model $role)
    {
        $this->elements[self::ELEM_NAME]->setValue($role->getName());
        if ($role->isSystemRole()) {
            //$this->elements[self::ELEM_NAME]->setAttribute('disabled', 'disabled');
        }
    }
}
