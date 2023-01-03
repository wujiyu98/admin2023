<?php

namespace App\Admin\Controllers;

use App\Banner;
use App\Language;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->column('language_id', __('Language id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'));
        $grid->column('url', __('Url'));
        $grid->column('title', __('Title'));
        $grid->column('summary', __('Summary'));

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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('language_id', __('Language id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('url', __('Url'));
        $show->field('title', __('Title'));
        $show->field('summary', __('Summary'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Banner());


        $form->select('language_id', __('Language'))
            ->default(1)
            ->required()
            ->options(Language::pluck('name', 'id'));
        $form->text('name', __('Name'));
        $form->image('image', __('Image'))
            ->removable()
            ->move("images/banner");
        $form->url('url', __('Url'));
        $form->text('title', __('Title'));
        $form->textarea('summary', __('Summary'));

        return $form;
    }
}
