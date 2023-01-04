<?php

namespace App\Admin\Controllers;

use App\Language;
use App\SiteInfo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SiteInfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SiteInfo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteInfo());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->column('language_id', __('Language id'))->display(function ($langID) {
            return Language::where('id', $langID)->first()->name;
        });
        $grid->column('site_name', __('Site name'));
        $grid->column('email', __('Email'));
        $grid->column('company', __('Company'));
        $grid->column('contact', __('Contact'));
        $grid->column('phone', __('Phone'));
        $grid->column('phone2', __('Phone2'));
        $grid->column('mobile_phone', __('Mobile phone'));
        $grid->column('skype', __('Skype'));
        $grid->column('qq', __('Qq'));
        $grid->column('whatsapp', __('Whatsapp'));
        $grid->column('address', __('Address'));

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
        $show = new Show(SiteInfo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('language_id', __('Language id'));
        $show->field('site_name', __('Site name'));
        $show->field('email', __('Email'));
        $show->field('company', __('Company'));
        $show->field('contact', __('Contact'));
        $show->field('phone', __('Phone'));
        $show->field('phone2', __('Phone2'));
        $show->field('mobile_phone', __('Mobile phone'));
        $show->field('skype', __('Skype'));
        $show->field('qq', __('Qq'));
        $show->field('whatsapp', __('Whatsapp'));
        $show->field('address', __('Address'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SiteInfo());

        $form->select('language_id', __('Language'))
            ->default(1)
            ->required()
            ->options(Language::pluck('name', 'id'));
        $form->text('site_name', __('Site name'));
        $form->email('email', __('Email'));
        $form->text('company', __('Company'));
        $form->text('contact', __('Contact'));
        $form->text('phone', __('Phone'));
        $form->text('phone2', __('Phone2'));
        $form->text('mobile_phone', __('Mobile phone'));
        $form->text('skype', __('Skype'));
        $form->text('qq', __('Qq'));
        $form->text('whatsapp', __('Whatsapp'));
        $form->text('address', __('Address'));
        $form->textarea('summary', __('Summary'))->attribute("maxlength", 2000);

        return $form;
    }
}
