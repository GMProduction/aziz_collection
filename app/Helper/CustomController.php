<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use Ramsey\Uuid\Uuid;

/**
 * Class CustomController
 * @package App\Helper
 */
class CustomController extends Controller
{

    protected $model;

    protected $validationRules = [];

    protected $validationMessage = [];

    /** @var Request $request */
    protected $request;

    protected $data = [];

    protected $tableFields = [];

    protected $tableActions = [];

    protected $now;

    /**
     * CustomController constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        date_default_timezone_set("Asia/Jakarta");
        $this->now = new DateTime();
    }

    public function insert($class = null, $data = [])
    {
        $model = new $class();
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }

        return $model->save() ? $model : false;
    }

    public function update($class = null, $data = [])
    {
        $id    = $this->request->request->get('id');
        $model = $class::find($id);
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }

        return $model->save() ? $model : false;
    }

    public function updateOther($class = null, $data = [])
    {
        $id    = $data['id'];
        $model = $class::find($id);
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }

        return $model->save() ? $model : false;
    }

    public function customUpdate($model = null, $data = [])
    {
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }

        return $model->save() ? $model : false;
    }

    public function directInsert($class = null, $data = [])
    {
        $model = new $class();
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        $model->save();

        return $model;
    }

    public function directUpdate($class = null, $id = 1, $data = [])
    {
        $model = $class::find($id);
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        $model->save();

        return $model;
    }

    public function generateImageName($field = '')
    {
        $value = '';
        if ($this->request->hasFile($field)) {
            $files     = $this->request->file($field);
            $extension = $files->getClientOriginalExtension();
            $name      = $this->uuidGenerator();
            $value     = $name.'.'.$extension;
        }

        return $value;
    }

    //disk setting on app/config/filesystem
    public function uploadImage($field, $targetName = '', $disk = 'upload')
    {
        $file = $this->request->file($field);

        return Storage::disk($disk)->put($targetName, File::get($file));
    }

    public function uploadImageWatermark($targetName = '', $file = 'image')
    {
        $watermark   = public_path('assets/img/common/logo.png');
        $image_water = \Intervention\Image\Facades\Image::make($this->request->file($file));
        $image_water->insert($watermark, 'bottom-left', 5, 5);
        $image_water->save('/home/u3974397/public_html/uploads/images/'.$targetName);
    }

    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }

    public function checkValidation(Request $request)
    {
        $data = $request->all();

        return Validator::make($data, $this->getValidationRules(), $this->getValidationMessage());
    }

    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * @param mixed $validationRules
     *
     * @return CustomController
     */
    public function setValidationRules($validationRules)
    {
        $this->validationRules = $validationRules;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidationMessage()
    {
        return $this->validationMessage;
    }

    /**
     * @param mixed $validationMessage
     *
     * @return CustomController
     */
    public function setValidationMessage($validationMessage)
    {
        $this->validationMessage = $validationMessage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     *
     * @return CustomController
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function postField($key)
    {
        return $this->request->request->get($key);
    }

    public function field($key)
    {
        return $this->request->query->get($key);
    }

    public function jsonResponse($data = '', $status = 200)
    {
        return response()->json(
            [
                'status'  => $status,
                'payload' => $data,
            ],
            $status
        );
    }

    public function convertToPdf($viewRender, $data = [])
    {
        $html = view($viewRender)->with($data);
        $pdf  = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        return $pdf->stream();
    }

    public function basicDataTables($object)
    {
        return DataTables::of($object)->addIndexColumn()->make(true);
    }

    /**
     * @param $template
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function renderView($template)
    {
        $this->data['tableFields'] = $this->tableFields;
        return view($template)->with($this->data);

    }

    /**
     * @param $data
     *
     * @return array|mixed|string|string[]
     */
    public function removeFroala($data)
    {
        $des = $data;
        $des = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $des
        );

        return $des;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function cekImgOlder($model,$id, $idParam = 'id')
    {
        $ctrl = '\\App\\Models\\'.$model;
        $student = $model::all()->where($idParam, '=', $id)->first();

        return $student;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function cekImgOlderAll($model,$id, $idParam = 'id')
    {
        $ctrl = '\\App\\Models\\'.$model;
        $student = $model::all()->where($idParam, '=', $id);

        return $student;
    }

    /**
     * @param $entity
     */
    public function unlinkImg($entity){
        if ($entity) {
            if (file_exists('../public'.$entity->image)) {
                if ($entity) {
                    if ($entity->image) {
                        unlink('../public'.$entity->image);
                    }
                }
            }
        }
    }

    /**
     * @param $entity
     */
    public function unlinkFile($entity){
        if ($entity) {
            if (file_exists('../public'.$entity->url)) {
                if ($entity) {
                    if ($entity->url) {
                        unlink('../public'.$entity->url);
                    }
                }
            }
        }
    }
}
