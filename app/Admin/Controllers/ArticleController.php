<?php

namespace App\Admin\Controllers;

use App\Article;
use App\ArticleCategory;
use App\Language;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());
        $grid->filter(function ($filter) {
            $filter->expand();
            $filter->disableIdFilter();
            $filter->equal('article_category_id', __("Select category"))->select(ArticleCategory::pluck('name', "id"));
        });


        $grid->column('id', __('Id'));

        $grid->column('title', __('Title'));
        $grid->column('pathname', __('Pathname'));
        $grid->column('sort_order', __('Sort order'));
        $grid->column('showed', __('Showed'));
        $grid->column('summary', __('Summary'));
        $grid->column('image', __('Image'));
        $grid->column('author', __('Author'));
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {

            return date_format(date_create($created_at), "Y-m-d H:i:s");
        });
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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('language_id', __('Language id'));
        $show->field('article_category_id', __('Article category id'));
        $show->field('title', __('Title'));
        $show->field('pathname', __('Pathname'));
        $show->field('sort_order', __('Sort order'));
        $show->field('showed', __('Showed'));
        $show->field('summary', __('Summary'));
        $show->field('image', __('Image'));
        $show->field('author', __('Author'));
        $show->field('content', __('Content'));
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
        $form = new Form(new Article());



        $form->select('language_id', __('Language'))
            ->default(1)
            ->required()
            ->options(Language::pluck('name', 'id'));
        $form->select('article_category_id', __('Select category'))
            ->required()
            ->options(ArticleCategory::pluck('name', 'id'));
        $form->text('title', __('Title'))
            ->required()
            ->attribute('maxlength', 255);
        $form->text('pathname', __('Pathname'))
            ->help('可不填，自动取标题路径，如手动填，空格请用-替换')
            ->attribute('maxlength', 255);
        $form->text('meta_title', __('Meta title'))
            ->help('长度最好不超过150个字符,可以跟标题一样')
            ->attribute('maxlength', 150);
        $form->text('meta_keywords', __('Meta keywords'))
            ->help('每个关键词用英文逗号分开,同时最好不超过5组关键词')
            ->attribute('maxlength', 120);
        $form->text('meta_description', __('Meta description'))
            ->help('长度最好不超过255个字符')
            ->attribute('maxlength', 255);
        $form->textarea('summary', __('Summary'));
        $form->image('image', __('Image'))
            ->resize(400, 200)
            ->uniqueName()
            ->move("images/posts")
            ->removable();
        $form->text('author', __('Author'));
        $form->number('sort_order', __('Sort order'))->min(0)->default(0);
        $form->switch('showed', __('Showed'))->default(1);
        $form->summernote('content', __('Content'));

        $form->saving(function (Form $form) {
            $title = strtolower($form->title);
            $title = trim($title);
            $title = preg_replace('/[\/\\\#\s\'",]+/', "-", $title);
            if (!$form->pathname) {
                $form->pathname = $title;
            }
            if (!$form->meta_title) {
                $form->meta_title = $form->title;
            }
        });


        return $form;
    }
}
