<?php

namespace App\Admin\Controllers;

use App\Language;
use App\Seo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SeoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Seo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Seo());

        $grid->filter(function ($filter) {
            $filter->equal('name', __("Name"));
        });
        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->column('language_id', __('Language id'));
        $grid->column('name', __('Name'));
        $grid->column('pathname', __('Pathname'));
        $grid->column('meta_title', __('Meta title'));
        $grid->column('meta_keywords', __('Meta keywords'));
        $grid->column('meta_description', __('Meta description'));

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
        $show = new Show(Seo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('language_id', __('Language id'));
        $show->field('name', __('Name'));
        $show->field('pathname', __('Pathname'));
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
        $form = new Form(new Seo());

        $form->select('language_id', __('Language'))
            ->default(1)
            ->required()
            ->options(Language::pluck('name', 'id'));
        $form->text('name', __('Name'));
        $form->text('pathname', __('Pathname'));
        $form->text('meta_title', __('Meta title'));
        $form->text('meta_keywords', __('Meta keywords'));
        $form->text('meta_description', __('Meta description'));

        return $form;
    }
}
