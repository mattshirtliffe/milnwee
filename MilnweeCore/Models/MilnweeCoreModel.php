<?php

namespace MilnweeCore\Models;

use Illuminate\Database\Eloquent\Model;

class MilnweeCoreModel extends Model
{
    public $_displayField = 'name';

    public $_columns = array();

    public $_className = '';

    public function __construct() {
        $this->_columns = $this->getTableColumns();
        $this->_className = get_class($this);
    }

    public function getTableColumns() {

        $cols = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());

        $traits = class_uses($this);
        foreach ($traits as $trait) {
            $traitName = basename($trait);
            switch ($traitName) {
                case 'RouteableTrait' :
                    $cols[] = 'route.id';
                    $cols[] = 'route.slug';
                    break;
            }
        }

        return $cols;
    }

    // a regular find, but loads all the data for the various
    // associations we have
    public function findForEdit($id) {

        $record = $this->find($id);

        $traits = class_uses($this);
        foreach ($traits as $trait) {
            $traitName = basename($trait);
            switch ($traitName) {
                case 'RouteableTrait' :
                    $record->load('route');
                    break;
            }
        }

        return $record;
    }


}
