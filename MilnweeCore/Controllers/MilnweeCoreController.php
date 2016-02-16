<?php

namespace MilnweeCore\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Console\AppNamespaceDetectorTrait;

use MilnweeFormHelper\FormHelper\FormHelper;
use MilnweeBreadcrumbs\BreadcrumbBuilder;

class MilnweeCoreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AppNamespaceDetectorTrait;

    public function __construct() {
        $this->_initialiseMilnweeCore();
    }

    /*
    variables used for "magic configs"
     */
    protected $_model = null;
    protected $_modelName = null;
    protected $_modelShortName = null;
    protected $_routeKey = null;
    protected $_modelFields = array();

    /*
    variables used when autoloading controllers
     */
    protected $_ignoreMe = false;

    /**
     * sets up a bunch of default stuff for milnwee core to use
     */
    protected function _initialiseMilnweeCore() {
        if (empty($this->_modelName)) {
            $this->_modelShortName = str_replace('Controller', '', class_basename(get_class($this)));
            $this->_modelShortName = str_singular($this->_modelShortName);
            $this->_modelName = $this->getAppNamespace() . $this->_modelShortName;
        }
        $this->_model = new $this->_modelName();
        $this->_routeKey = strtolower(str_plural($this->_modelShortName));
    }

    protected function _getModelFields() {
        if (empty($this->_modelFields)) {
            return $this->_model->_columns;
        }

        return $this->_modelFields;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $breadcrumbs = new BreadcrumbBuilder();
        $breadcrumbs->addChunk(array(
            str_plural($this->_modelShortName),
            'admin.' . $this->_routeKey . '.index'
        ));

        $breadcrumbs->addChunk(array(
            'Index',
        ));

        $items = $this->_model->all();
        return view('milnweecore.index', array(
            'items' => $items,
            'routeKey' => $this->_routeKey,
            'breadcrumbs' => $breadcrumbs,
            'model' => $this->_modelShortName,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $FormHelper = new FormHelper($this->_modelShortName);

        $breadcrumbs = new BreadcrumbBuilder();
        $breadcrumbs->addChunk(array(
            str_plural($this->_modelShortName),
            'admin.' . $this->_routeKey . '.index'
        ));
        $breadcrumbs->addChunk(array(
            'Add new Event'
        ));

        return view('milnweecore.create', array(
            'FormHelper' => $FormHelper,
            'fields' => $this->_getModelFields(),
            'routeKey' => $this->_routeKey,
            'breadcrumbs' => $breadcrumbs,
            'model' => $this->_modelShortName,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // data from the request
        $requestData = $request->data;

        // any association data to save
        $associationData = array();

        foreach ($requestData[$this->_modelShortName] as $key => $value) {
            if (!empty($value)) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        $associationData[$key] = array(
                            $subKey => $subValue
                        );
                    }
                } else {
                    $this->_model->$key = $value;
                }
            }
        }

        // save the main model
        $this->_model->save();

        // save any associated data
        foreach ($associationData as $key => $data) {
            $saveFuncName = 'save' . ucwords($key);
            $this->_model->$saveFuncName($this->_model, $data);
        }

        return redirect(route("admin.$this->_routeKey.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $record = $this->_model->findForEdit($id);

        $data = array();
        foreach ($record->toArray() as $key => $value) {
            $data[$this->_modelShortName . '.' . $key] = $value;
        }
        $FormHelper = new FormHelper($this->_modelShortName, $data);

        $breadcrumbs = new BreadcrumbBuilder();
        $breadcrumbs->addChunk(array(
            str_plural($this->_modelShortName),
            'admin.' . $this->_routeKey . '.index'
        ));
        $breadcrumbs->addChunk(array(
            'Edit Event'
        ));

        return view('milnweecore.edit', array(
            'FormHelper' => $FormHelper,
            'fields' => $this->_getModelFields(),
            'record' => $record,
            'routeKey' => $this->_routeKey,
            'breadcrumbs' => $breadcrumbs,
            'model' => $this->_modelShortName,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->data;
        $record = $this->_model->find($id);

        // assign the request data to either the main record
        // or the association data array, so we can save it afterwards
        $associationData = array();
        foreach ($requestData[$this->_modelShortName] as $key => $value) {
            if (!empty($value)) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        $associationData[$key][$subKey] = $subValue;
                    }
                } else {
                    $record->$key = $value;
                }
            }
        }

        // save the main model
        $record->save();

        // save any associated data
        foreach ($associationData as $key => $data) {
            $saveFuncName = 'save' . ucwords($key);
            $record->$saveFuncName($record, $data);
        }

        return redirect(route("admin.$this->_routeKey.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->_model->destroy($id);

        return redirect(route("admin.$this->_routeKey.index"));
    }

    public function getModelShortName() {
        return $this->_modelShortName;
    }

    public function getRouteKey() {
        return $this->_routeKey;
    }
}
