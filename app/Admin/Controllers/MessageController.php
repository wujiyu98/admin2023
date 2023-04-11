<?php

namespace App\Admin\Controllers;

use App\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Message';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message());

        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->model()->orderBy("id", "desc");

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('country', __('Country'));
        $grid->column('mobile_phone', __('Mobile phone'));
        $grid->column('company', __('Company'));
        $grid->column('comment', __('Comment'))->width(300);
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(Message::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('country', __('Country'));
        $show->field('mobile_phone', __('Mobile phone'));
        $show->field('company', __('Company'));
        $show->field('comment', __('Comment'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Message());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->text('country', __('Country'));
        $form->text('mobile_phone', __('Mobile phone'));
        $form->text('company', __('Company'));
        $form->text('comment', __('Comment'));

        return $form;
    }
}
