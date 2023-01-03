<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Language;
use App\Manufacturer;
use App\Product;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Database\Eloquent\Collection;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->filter(function ($filter) {
            $filter->equal('title', __("Title"));
            $filter->equal('hot', __("Hot"))->radio([
                0    => '否',
                1    => '是',
            ]);
            $filter->equal('new', __("New"))->radio([
                0    => '否',
                1    => '是',
            ]);
            $filter->equal('special', __("Special"))->radio([
                0    => '否',
                1    => '是',
            ]);
        });
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->width(200);
        $grid->column('language_id', __('Language id'));
        $grid->column('manufacturer_id', __('Manufacturer id'));
        $grid->column('price', __('Price'));
        $grid->column('sort_order', __('Sort order'));
        $grid->column('showed', __('Showed'))->switch();

        $grid->column('hot', __('Hot'))->switch();
        $grid->column('new', __('New'))->switch();
        $grid->column('special', __('Special'))->switch();

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));


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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('language_id', __('Language id'));
        $show->field('category_id', __('Category id'));
        $show->field('manufacturer_id', __('Manufacturer id'));
        $show->field('title', __('Title'));
        $show->field('pathname', __('Pathname'));
        $show->field('sort_order', __('Sort order'));
        $show->field('showed', __('Showed'));
        $show->field('summary', __('Summary'));
        $show->field('image', __('Image'));
        $show->field('images', __('Images'));
        $show->field('content', __('Content'));
        $show->field('stock', __('Stock'));
        $show->field('hot', __('Hot'));
        $show->field('new', __('New'));
        $show->field('special', __('Special'));
        $show->field('price', __('Price'));
        $show->field('prices', __('Prices'));
        $show->field('meta_title', __('Meta title'));
        $show->field('meta_keywords', __('Meta keywords'));
        $show->field('meta_description', __('Meta description'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());





        $form->tab('基本信息', function ($form) {
            $form->select('language_id', __('Language'))
                ->default(1)
                ->required()
                ->options(Language::pluck('name', 'id'));
            $form->select('category_id', __('Category id'))
                ->options(Category::where("parent_id", ">", 0)->pluck("name", 'id'));
            $form->select('manufacturer_id', __('Manufacturer id'))
                ->options(Manufacturer::pluck("name", 'id'));
            $form->text('title', __('Title'));
            $form->text('pathname', __('Pathname'));
            $form->textarea('summary', __('Summary'));
            $form->text('meta_title', __('Meta title'));
            $form->text('meta_keywords', __('Meta keywords'));
            $form->text('meta_description', __('Meta description'));
            $form->number('stock', __('Stock'))->min(0);
            $form->decimal('price', __('Price'));
            $form->keyValue('prices', __('Prices') . "");

            $form->switch('hot', __('Hot'));
            $form->switch('new', __('New'));
            $form->switch('special', __('Special'));
            $form->number('sort_order', __('Sort order'))->min(0);
            $form->switch('showed', __('Showed'))->default(1);
        })->tab("图片", function ($form) {
            $form->image('image', __('Image'))
                ->resize(500, 500)
                ->uniqueName()
                ->move("images/product_new")
                ->removable()
                ->retainable();
            $form->multipleImage('images', __('Images'))->sortable()->removable();
        })->tab("属性", function ($form) {
            $form->hasMany('attributes', "属性组：键指名称", function (Form\NestedForm $form) {
                $form->text('key', __('Key'));
                $form->text('value', __('Value'));
            });
        })->tab("内容编辑", function ($form) {
            $form->textarea('content', __('Content'));
        });

        $form->saving(function (Form $form) {
            $title = strtolower($form->title);
            $title = trim($title);
            $title = preg_replace('/[\/\\\#\s\'",]+/', "-", $title);
            if (!$form->pathname) {
                $m = Manufacturer::where("id", $form->manufacturer_id)->first();

                $form->pathname = $m->pathname . "-" . $title;
            }
            if (!$form->meta_title) {
                $form->meta_title = $form->title;
            }
        });


        return $form;
    }
}
