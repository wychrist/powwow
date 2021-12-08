<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Lib\Ui\Element;

/**
 * Description of Table
 *
 * @author unleash
 */
class Table extends \App\Lib\Ui\Html
{

    const TYPE_SIMPLE = 'simple',
            TYPE_STRIPED = 'striped',
            TYPE_CONDENSED = 'condensed',
            TYPE_BORDERED = 'bordered';

    private $Header;
    private $Footer;
    private $HeaderRow;
    private $FooterRow;
    private $searchRow;
    private $body;
    private $rowCount = 0;
    private $columnSearchFields = [];
    private $typeType = self::TYPE_SIMPLE;
    private $Ui;

    public function __construct(\App\Service\Face\UiServiceInterface $Ui, $id = false)
    {
        parent::__construct(false, $id);
        $this->setTag('table');
        $this->Header = $this->add('thead', $id . '_thead');
        $this->HeaderRow = $this->Header->add('tr');
        $this->body = $this->add('tbody', $id . '_tbody');

        $this->searchRow = $this->body->add('tr', 'tr_search_' . $id);
        $this->searchRow->set('style', 'display:none')->set('id', 'search_row_' . $this->get('id'));

        // footer
        $this->Footer = $this->add('tfoot');
        $this->FooterRow = $this->Footer->add('tr');
        $this->Ui = $Ui;
    }

    public function getSearchRow()
    {
        return $this->searchRow;
    }

    public function getHeader()
    {
        return $this->Header;
    }

    public function getBody()
    {
        return $this->body;
    }

    protected function getSearchFieldPrefix()
    {
        return 'search_field_';
    }

    public function addColumn($title, $id, $searchable = true, array $searchOptions = [])
    {
        $col = $this->HeaderRow->add('th', $id);
        $col->text = $title;
        $this->FooterRow->add('th')->text = $title;


        if ($searchable) {
            $td = $this->searchRow->add('td');

            if (!empty($searchOptions)) {
                $searchField = $this->Ui->newUi('select');
                $searchField->set('id', $id . '_searchoption');
                $td->addNode($searchField);
                foreach ($searchOptions as $key => $value) {
                    $searchField->add('option')->set('value', $key)->text = $value;
                }
                $searchField->set('onchange', 'filterTable(' . $this->get('id') . ',this)');
            } else {
                $searchField = $this->Ui->newUi('input');
                $td->addNode($searchField);

                $searchField->set('id', $id . '_searchbox')
                        ->set('type', 'text')
                        ->set('name', $title)
                        ->set('data-col-id', $id)
                        ->set('onkeyup', 'filterTable(' . $this->get('id') . ',this)');
            }
            $this->columnSearchFields[$id] = $searchField;
            $this->searchRow->set('display', '');
        }

        return $col;
    }

    public function getSearchField($columnId)
    {
        return (isset($this->columnSearchFields[$columnId])) ? $this->columnSearchFields[$columnId] : false;
    }

    public function getSearchFields()
    {
        return $this->columnSearchFields;
    }

    public function addRow(array $data = [])
    {
        $tr = $this->getBody()->add('tr', 'tr_' . $this->rowCount)->set('class', 'data-tr-row');

        foreach ($this->HeaderRow->getChildren() as $child) {
            $tr->add('td', $tr->get('id') . '_td_' . $child->get('id'))->set('class', 'td-' . $child->get('id'));
        }

        foreach ($data as $key => $value) {
            if ($this->HeaderRow->has($key)) {
                $tr->getNode($tr->get('id') . '_td_' . $key)->text = $value;
            }
        }
        $this->rowCount++;

        return $tr;
    }

    public function setTableType($type)
    {
        $this->typeType = $type;
    }

    public function getTableType()
    {
        return $this->typeType;
    }

}
