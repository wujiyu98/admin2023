<?php

namespace App\Admin\Controllers;

use App\Enquiry;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class EnquiryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Enquiry';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Enquiry());
        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->filter(function ($filter) {
            $filter->equal('email', __("Email"));
            $filter->equal('name', __("Name"));
            $filter->equal('country', __("Country"));
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('country', __('Country'));
        $grid->column('mobile_phone', __('Mobile phone'));
        $grid->column('company', __('Company'));
        $grid->column('comment', __('Comment'));
        $grid->column('sss', __('Products'))->expand(function ($model) {
            $products = $model->products;
            return new Table(['Qty', 'Price', 'Title', 'Summary', 'Manufacturer'], $products);
        });
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
        $show = new Show(Enquiry::findOrFail($id));

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
        $show->field('products', __('Products'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Enquiry());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->text('country', __('Country'));
        $form->text('mobile_phone', __('Mobile phone'));
        $form->text('company', __('Company'));
        $form->text('comment', __('Comment'));
        $form->text('products', __('Products'));

        return $form;
    }
}
