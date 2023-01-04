<?php

namespace App\Admin\Controllers;

use App\ArticleCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ArticleCategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleCategory());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('pathname', __('Pathname'));
        $grid->column('sort_order', __('Sort order'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(ArticleCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('name', __('Name'));
        $show->field('pathname', __('Pathname'));
        $show->field('parent_id', __('Parent id'));
        $show->field('sort_order', __('Sort order'));
        $show->field('image', __('Image'));
        $show->field('summary', __('Summary'));
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
        $form = new Form(new ArticleCategory());

        $form->text('name', __('Name'))->required();
        $form->text('pathname', __('Pathname'))
            ->help('可不填，自动取标题路径，如手动填，空格请用-替换')
            ->attribute('maxlength', 255);;
        $form->text('meta_title', __('Meta title'))
            ->help('长度最好不超过150个字符，可以跟标题一样')
            ->attribute('maxlength', 150);
        $form->text('meta_keywords', __('Meta keywords'))
            ->help('每个关键词用英文逗号分开，同时最好不超过5组关键词')
            ->attribute('maxlength', 120);
        $form->text('meta_description', __('Meta description'))
            ->help('长度最好不超过255个字符')
            ->attribute('maxlength', 255);
        $form->number('sort_order', __('Sort order'))->default(0)->min(0);
        $form->image('image', __('Image'))
            ->move("images/posts")
            ->removable();
        $form->textarea('summary', __('Summary'));
        $form->saving(function (Form $form) {
            $title = strtolower($form->name);
            $title = trim($title);
            $title = preg_replace('/[\/\\\#\s\'",]+/', "-", $title);
            $path = $form->pathname;
            if (!$path) {
                $form->pathname = $title;
            }
            if (!$form->meta_title) {
                $form->meta_title = $form->name;
            }
        });


        return $form;
    }
}
