<?php

namespace App\Admin\Controllers;

use App\Models\Tel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Actions\Tenant\ImportTenant;
use Illuminate\Support\Facades\DB;

class TelController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('号码管理')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('号码管理')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('修改页面')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建页面')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tel);

        $grid->id('ID');
        $grid->column('tel','电话');
        $grid->column('up_time','日期');
        $grid->column('status','状态')->editable('select', [0 => '没有赠送', 1 => '已赠送']);
        $grid->created_at(trans('admin.created_at'));
        $grid->tools(function (Grid\Tools $tools) {
            //$tools->append(new ImportTenant());
            $tools->append("<a class='btn btn-sm btn-info' href='https://9373777.com/moban.xlsx'>模板下载</a>");
            $tools->append("<a class='btn btn-sm btn-default' target='_blank' href='/sgeretertrtrtertr1.php'>TXT上传</a>");
            //$tools->append("<a class='btn btn-sm btn-danger' href='deleteall'>清空所有</a>");
        });
        $grid->quickSearch('tel','up_time','status');
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Tel::findOrFail($id));

        $show->id('ID');
        $show->tel('tel');
        $show->up_time('up_time');
        $show->status('status');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Tel);

        $form->display('ID');
        $form->text('tel', '电话');
        $form->text('up_time', '日期');
        $form->select('status', '状态')->options([0 => '没有赠送', 1 => '已赠送']);
        $form->display(trans('admin.created_at'));
        $form->display(trans('admin.updated_at'));

        return $form;
    }

    public function delall(){
        $r=DB::statement('truncate table users');
        return $this->response()->success('已清空！')->refresh();
    }
    public function download(){
        $r=DB::statement('truncate table users');
        return $this->response()->success('已清空！')->refresh();
    }
}
