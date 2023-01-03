<?php

namespace App\Admin\Controllers;

use App\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));

        $grid->column('user_id', __('User id'));
        $grid->column('order_number', __('Order number'));
        $grid->column('address', __('Address'));
        $grid->column('transaction_number', __('Transaction number'));
        $grid->column('paypal_fee', __('Paypal fee'));
        $grid->column('total', __('Total'));
        $grid->column('payment', __('Payment'));
        $grid->column('status', __('Status'));
        $grid->column('freight', __('Freight'));
        $grid->column('express', __('Express'));
        $grid->column('tracking_number', __('Tracking number'));
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('user_id', __('User id'));
        $show->field('order_number', __('Order number'));
        $show->field('address', __('Address'));
        $show->field('transaction_number', __('Transaction number'));
        $show->field('paypal_fee', __('Paypal fee'));
        $show->field('total', __('Total'));
        $show->field('payment', __('Payment'));
        $show->field('status', __('Status'));
        $show->field('freight', __('Freight'));
        $show->field('express', __('Express'));
        $show->field('tracking_number', __('Tracking number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->number('user_id', __('User id'));
        $form->text('order_number', __('Order number'));
        $form->text('address', __('Address'));
        $form->text('transaction_number', __('Transaction number'));
        $form->decimal('paypal_fee', __('Paypal fee'))->default(0.00);
        $form->decimal('total', __('Total'));
        $form->switch('payment', __('Payment'));
        $form->switch('status', __('Status'));
        $form->decimal('freight', __('Freight'))->default(35.00);
        $form->text('express', __('Express'));
        $form->text('tracking_number', __('Tracking number'));

        return $form;
    }
}
